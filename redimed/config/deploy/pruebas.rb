set :user, "root"
set :use_sudo, false
set :repository, "svn://svn.lemontech.cl/bpre2/produccion"
role :app, "10.100.32.198", "10.100.32.199"
