@echo off
:loop
php "D:\ABDULLAH WORK\ABDULLAH ( ME)\All Projects And Portfolio\Laravel Portfolio Projects\CRM\artisan" schedule:run
timeout /t 60
goto loop