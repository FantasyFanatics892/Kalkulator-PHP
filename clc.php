<?php
function color_text($text, $color_code) {
  return "\033[" . $color_code . "m" . $text . "\033[0m";
}

function center_text($text, $width) {
  $terminal_width = exec('tput cols'); 
  $left_padding = str_repeat(' ', max(0, ($terminal_width - $width) / 2));
  return $left_padding . $text;
}

function display_team() {
  $team = [
    "Kelompok 2 - X TKJ 2",
    "1. Sultan Faiz Ar-Rasyid",
    "2. Rifky Abdillah",
    "3. Sami Abdillah",
    "4. Restu Rosenda",
    "5. Zakariyya",
    "6. Rezky Aditya",
    "7. Ukasyah Rayyan Ramadhan Dalimunthe",
    "8. Salman Hafiz Mubarok"
  ];
  $team_color = "1;31";
  foreach ($team as $member) {
    echo color_text($member, $team_color) . "\n";
    sleep(1);
  }
  echo "\n";
}

function display_menu() {
  $menu = [
    "1. Pertambahan",
    "2. Pengurangan",
    "3. Perkalian",
    "4. Pembagian",
    "5. Modulus",
    "6. Perpangkatan",
    "7. Tutorial",
    "8. Penjelasan",
    "0. Keluar"
  ];
  $menu_color = "1;34";
  $text_color = "1;34";
  $max_length = max(array_map('strlen', $menu));
  $max_length += 4; // Menambahkan ruang ekstra di dalam tabel

  // Menggunakan padding kiri agar tabel di tengah
  $padding_left = center_text("", $max_length + 4);

  echo color_text($padding_left . "╔" . str_repeat("═", $max_length) . "╗", $menu_color) . "\n";
  foreach ($menu as $item) {
    echo color_text($padding_left . "║ " . str_pad($item, $max_length - 2) . " ║", $text_color) . "\n";
  }
  echo color_text($padding_left . "╚" . str_repeat("═", $max_length) . "╝", $menu_color) . "\n";
}

function arithmetic_operation($operation, $a, $b) {
  $a = floatval($a);
  $b = floatval($b);
  switch ($operation) {
    case '+':
      return $a + $b;
    case '-':
      return $a - $b;
    case '*':
      return $a * $b;
    case '/':
      if ($b == 0) {
        return "Error: Pembagian dengan nol!";
      }
      return $a / $b;
    case '%':
      if ($b == 0) {
        return "Error: Modulus dengan nol!";
      }
      return $a % $b;
    case '^':
      return pow($a, $b);
    default:
      return "Error: Operasi tidak dikenal.";
  }
}

function calculate($choice) {
  switch ($choice) {
    case 1:
      echo "Masukkan angka pertama: ";
      $a = trim(fgets(STDIN));
      echo "Masukkan angka kedua: ";
      $b = trim(fgets(STDIN));
      echo "Hasil: " . arithmetic_operation('+', $a, $b) . "\n";
      break;
    case 2:
      echo "Masukkan angka pertama: ";
      $a = trim(fgets(STDIN));
      echo "Masukkan angka kedua: ";
      $b = trim(fgets(STDIN));
      echo "Hasil: " . arithmetic_operation('-', $a, $b) . "\n";
      break;
    case 3:
      echo "Masukkan angka pertama: ";
      $a = trim(fgets(STDIN));
      echo "Masukkan angka kedua: ";
      $b = trim(fgets(STDIN));
      echo "Hasil: " . arithmetic_operation('*', $a, $b) . "\n";
      break;
    case 4:
      echo "Masukkan angka pertama: ";
      $a = trim(fgets(STDIN));
      echo "Masukkan angka kedua: ";
      $b = trim(fgets(STDIN));
      echo "Hasil: " . arithmetic_operation('/', $a, $b) . "\n";
      break;
    case 5:
      echo "Masukkan angka pertama: ";
      $a = trim(fgets(STDIN));
      echo "Masukkan angka kedua: ";
      $b = trim(fgets(STDIN));
      echo "Hasil: " . arithmetic_operation('%', $a, $b) . "\n";
      break;
    case 6:
      echo "Masukkan angka pertama: ";
      $a = trim(fgets(STDIN));
      echo "Masukkan angka kedua: ";
      $b = trim(fgets(STDIN));
      echo "Hasil: " . arithmetic_operation('^', $a, $b) . "\n";
      break;
    case 7:
      display_tutorial();
      break;
    case 8:
      display_explanation();
      break;
    case 0:
      echo "Terima kasih telah menggunakan kalkulator ini!\n";
      exit();
    default:
      echo "Pilihan tidak valid.\n";
  }

  // Konfirmasi pengguna apakah ingin lanjut atau kembali ke menu utama
  echo "Apakah Anda ingin melanjutkan perhitungan? (y/n): ";
  $confirm = trim(fgets(STDIN));
  if (strtolower($confirm) != 'y') {
    display_menu();
  }
}

function display_tutorial() {
  echo "\n--- Tutorial ---\n";
  echo "1. Pilih opsi dari menu utama untuk jenis perhitungan yang ingin dilakukan.\n";
  echo "2. Masukkan angka atau ekspresi yang sesuai dengan opsi yang dipilih.\n";
  echo "  - Pilihan 1-6: Operasi aritmatika dasar (+, -, *, /, %, ^).\n";
  echo "  - Pilihan 7: Tampilkan tutorial.\n";
  echo "  - Pilihan 8: Tampilkan penjelasan tentang program ini.\n";
  echo "  - Pilihan 0: Keluar dari program.\n";
  echo "\nTekan Enter untuk kembali ke menu utama...";
  trim(fgets(STDIN));
}

function display_explanation() {
  echo "\n--- Penjelasan ---\n";
  echo "\n Kalkulator ini dibuat oleh Kelompok 2 di Kelas TKJ-2\n";
  echo "Semoga dengan Program Kalkulator ini, kelompok 2 dapat nilai tertinngi. >_<\n";
  echo "Tekan Enter untuk kembali...";
  trim(fgets(STDIN));
}

display_team();
while (true) {
  display_menu();
  echo "Pilih opsi: ";
  $choice = trim(fgets(STDIN));
  calculate($choice);
  sleep(2);
}
?>
