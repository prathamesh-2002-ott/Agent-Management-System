echo off
cd \
cd wamp\bin\mysql\mysql5.0.45\bin\
mysqldump --user root  textile  --result-file="c:\AgencyMgmt\backup\textiledump1_%date:~6,4%-%date:~3,2%-%date:~0,2%-%time:~0,2%-%time:~3,2%-%time:~6,2%.sql

exit