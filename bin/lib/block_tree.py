"""Block-comment parser shared by the bin/check-*.sh scripts.

Patterns are PHP files whose body is block markup, so the block tree is read from the
`<!-- wp:name {json} -->` comments alone. PHP inside an attribute (an image URL built
with esc_url) is replaced before the JSON is parsed, since a check never needs its value.
"""

import json
import re

TOKEN = re.compile(r'<!--\s+(/)?wp:([a-z0-9/-]+)(\s+(\{.*?\}))?\s*(/)?-->', re.S)
PHP = re.compile(r'<\?php.*?\?>', re.S)


def parse(path):
    """Return the root node of the file's block tree. Each node is a dict with name,
    attrs, children, parent and line."""
    text = open(path).read()
    root = {'name': 'root', 'attrs': {}, 'children': [], 'parent': None, 'line': 0}
    stack = [root]
    for m in TOKEN.finditer(text):
        close, name, _, raw, self_closing = m.groups()
        if close:
            if len(stack) > 1:
                stack.pop()
            continue
        try:
            attrs = json.loads(PHP.sub('', raw)) if raw else {}
        except ValueError:
            attrs = {}
        node = {
            'name': name,
            'attrs': attrs,
            'children': [],
            'parent': stack[-1],
            'line': text.count('\n', 0, m.start()) + 1,
        }
        stack[-1]['children'].append(node)
        if not self_closing:
            stack.append(node)
    return root


def walk(node):
    yield node
    for child in node['children']:
        yield from walk(child)


def ancestors(node):
    node = node['parent']
    while node is not None:
        yield node
        node = node['parent']


def class_names(node):
    return node['attrs'].get('className', '').split()


# Fills by surface: white, tinted or dark. Shared by the checks that follow the ground a
# block sits on (secondary buttons, stat figures).
SLUGS = {
    'surface-base': 'white',
    'surface-muted': 'tinted', 'surface-subtle': 'tinted',
    'surface-subtle-hover': 'tinted', 'border': 'tinted', 'on-dark': 'tinted',
    'text-heading': 'dark', 'text-body': 'dark', 'text-muted': 'dark',
}
RAW = {
    '#fff': 'white', '#ffffff': 'white', 'var(--wp--preset--color--surface-base)': 'white',
    '#f3f4f6': 'tinted', 'var(--wp--preset--color--surface-muted)': 'tinted',
    '#111827': 'dark', 'var(--wp--custom--dark--bg)': 'dark',
    'var(--wp--preset--color--text-heading)': 'dark',
}


def surface(node):
    """The fill of the nearest ancestor that sets one, or None if none does."""
    a = node['attrs']
    if node['name'] == 'cover':
        return 'white' if a.get('isDark') is False else 'dark'
    if a.get('backgroundColor'):
        return SLUGS.get(a['backgroundColor'], '?' + a['backgroundColor'])
    raw = a.get('style', {}).get('color', {}).get('background')
    if raw:
        if raw.startswith('var:preset|color|'):
            slug = raw.split('|')[-1]
            return SLUGS.get(slug, '?' + slug)
        return RAW.get(raw.lower(), '?' + raw)
    if a.get('gradient') or a.get('style', {}).get('color', {}).get('gradient'):
        return '?gradient'
    # header-marketing carries its fill as a class rather than the attribute.
    for name in class_names(node):
        if name.startswith('has-') and name.endswith('-background-color'):
            slug = name[len('has-'):-len('-background-color')]
            return SLUGS.get(slug, '?' + slug)
    return None


def ground(node):
    """The surface of the nearest ancestor that sets a fill: white, tinted, dark, or
    '?<fill>' for a fill not classified above. No fill anywhere is white."""
    for up in ancestors(node):
        found = surface(up)
        if found:
            return found
    return 'white'
