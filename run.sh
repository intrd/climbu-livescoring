#!/bin/bash
echo  'ClimbU - Dynamic and open source live scoring for competitions'
echo  '@copyright (C) @intrd - http://dann.com.br'

echo '*** Loading webserver, please do not close this window.'
echo '# Webserver listening on http:\\localhost:80'

sudo php -S 0.0.0.0:80 -t ./www
