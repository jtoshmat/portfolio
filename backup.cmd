@ECHO OFF
ECHO "DAILY QRF BACKUP"
XCOPY * U:\Backups\QRF /s /i /Y /d
cmd /k