@echo off
REM ─────────────────────────────────────────────────────────────
REM  YONBUS — Database SQL Export Script
REM  Run this from PowerShell or double-click to regenerate
REM  the SQL dump for phpMyAdmin import.
REM
REM  Usage: .\scripts\export_to_sql.bat
REM  Output: yonbus_export.sql (in project root)
REM ─────────────────────────────────────────────────────────────

echo.
echo [YONBUS] Generating SQL export...
echo.

php scripts\dump_sql.php

echo.
pause
