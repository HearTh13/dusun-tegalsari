<?php
session_start();            // Mulai session
session_unset();            // Hapus semua variabel session
session_destroy();          // Hancurkan session

// Redirect ke halaman login (atau index)
header("Location: home");
exit();