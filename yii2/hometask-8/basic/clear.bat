@echo off

k:
cd k:\domains\yii2\basic\runtime\cache\
del k:\domains\yii2\basic\runtime\cache\*.* /s /q
del k:\domains\yii2\basic\runtime\mail\*.* /s /q

goto start
:fn1
for /d %%i in ("%~1\*") do (call :fn1 "%%i" & rd /q "%%i")
exit /b
:start
call :fn1 "k:\domains\yii2\basic\runtime\cache\"