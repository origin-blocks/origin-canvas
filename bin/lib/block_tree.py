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
