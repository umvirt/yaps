RewriteEngine On
RewriteBase /

RewriteRule ^user(/?)$ %sitepath%/index.php?ns=user
RewriteRule ^user/loginfrm(/?)$ %sitepath%/index.php?ns=user&action=loginfrm
RewriteRule ^user/login(/?)$ %sitepath%/index.php?ns=user&action=login
RewriteRule ^user/logout(/?)$ %sitepath%/index.php?ns=user&action=logout

RewriteRule ^user/setlocale/([a-zA-z0-9.-]+)(/?)$ %sitepath%/index.php?ns=user&action=setlocale&code=$1

