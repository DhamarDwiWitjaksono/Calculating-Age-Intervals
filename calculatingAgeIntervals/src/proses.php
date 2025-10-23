<?php
header("Content-Type: application/json");

class AgeGap {
    private $tahun;
    private $bulan;
    private $tanggal;

    public function __construct($tahun, $bulan, $tanggal) {
        $this->tahun = $tahun;
        $this->bulan = $bulan;
        $this->tanggal = $tanggal;
    }

    public function toDate() {
        return new DateTime("{$this->tahun}-{$this->bulan}-{$this->tanggal}");
    }

    public function calculate() {
        $tanggalAwal = $this->toDate();
        $tanggalSekarang = new DateTime();

        $interval = $tanggalAwal->diff($tanggalSekarang);

        return [
            "tahun" => $interval->y,
            "bulan" => $interval->m,
            "hari" => $interval->d,
        ];
    }
}

if (isset($_POST['tahun'], $_POST['bulan'], $_POST['tanggal'])) {
    $age = new AgeGap($_POST['tahun'], $_POST['bulan'], $_POST['tanggal']);
    $hasil = $age->calculate();

    echo json_encode([
        "success" => true,
        "tahun" => $hasil["tahun"],
        "bulan" => $hasil["bulan"],
        "hari" => $hasil["hari"]
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Input tidak lengkap."
    ]);
}
?>
