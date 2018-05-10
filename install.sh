#!/usr/bin/env bash
git clone https://github.com/HQ6968/phptests.git
cd phptests
ln -s $(pwd)/index.php /usr/bin/phptest
chmod +x /usr/bin/phptest
