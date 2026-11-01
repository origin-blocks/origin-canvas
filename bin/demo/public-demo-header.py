"""Turn the Header Marketing pattern's markup into the public demo's header part.

Usage: public-demo-header.py <header.html> <menu post id> <contact page url>
The logo grows to 200 px, the site title goes (the logo carries the name), the navigation
points at the seeded menu, the filled button goes and the outline one reads "Get in touch"
and links to the contact page.
"""
import re
import sys

path, menu_id, contact = sys.argv[1], sys.argv[2], sys.argv[3]
t = open(path).read()
t = t.replace('"width":24', '"width":200', 1)
t = re.sub(r'<!-- wp:site-title .*?/-->\s*', '', t, count=1, flags=re.S)
t = re.sub(r'<!-- wp:navigation \{', '<!-- wp:navigation {"ref":%s,' % menu_id, t, count=1)
t = re.sub(r'<!-- wp:button \{"style".*?<!-- /wp:button -->\s*', '', t, count=1, flags=re.S)
t = re.sub(r'"blockVisibility":\{[^}]*\{[^}]*\}\}', '"blockVisibility":{}', t, count=1)
t = re.sub(r'>(View demo|Download|Get in Touch)<', '>Get in touch<', t)
t = re.sub(r'(<a class="wp-block-button__link[^>]*?)href="[^"]*"', r'\1href="' + contact + '"', t, count=1)
if contact not in t:
    t = t.replace('<a class="wp-block-button__link', '<a href="' + contact + '" class="wp-block-button__link', 1)
open(path, 'w').write(t)
