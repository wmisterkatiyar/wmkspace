Check if svn is installed
> which svn
install it
> yum install subversion
we get three new commands svn, svnadmin, svnserve
create new rep
> mkdir /var/svn/
> svnadmin create project1
svn has per repo basis conf
> vi conf/svnserve.conf
    and confirm for:
    anon-access = none
    auth-access = write
    password-db = passwd
> vi conf/passwd
    [users]
    user_name = password
> svnserve --daemon --listen-host 0.0.0.0 --root .
to check
> ps -A | grep svn
> ps aux | grep svn
> pstree
to stop process
> kill _pid_
> killall _name_