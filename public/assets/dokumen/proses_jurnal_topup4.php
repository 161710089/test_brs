$kode_kantor2 = get_kode_kantor();
$id_menu2 = _get_menu_id2();
if(_get_jenis_kantor() == 'upt'){
    $keterangan = "Top Up saldo Member";
    $keterangan_jurnal = "Top Up saldo Member ".get_prefix_jurnal();
    $coa_debet = get_pengaturan_coa($id_menu2, 'kas_upt_topup_upt');
    $coa_kredit = get_pengaturan_coa($id_menu2, 'kas_emoney_topup_upt');
    create_jurnal2($kode_transaksi, $kode_kantor2, $coa_debet, $nominal, 'debet', $keterangan, $keterangan_jurnal);
    create_jurnal2($kode_transaksi, $kode_kantor2, $coa_kredit, $nominal, 'kredit', $keterangan, $keterangan_jurnal);
}elseif(_get_jenis_kantor() != "upt"){
    $keterangan = "Top Up saldo UPT";
    $keterangan_jurnal = "Top Up saldo UPT ".get_prefix_jurnal();
    $coa_debet = get_pengaturan_coa($id_menu2, 'piutang_emoney_topup_upt');
    $coa_kredit = get_pengaturan_coa($id_menu2, 'kas_emoney_ho_topup_upt');
    $coa_debet2 = get_pengaturan_coa($id_menu2, 'kas_emoney_upt_topup_upt');
    $coa_kredit2 = get_pengaturan_coa($id_menu2, 'hutang_emoney_topup_upt');
    create_jurnal2($kode_transaksi, $kode_kantor2, $coa_debet, $nominal, 'debet', $keterangan, $keterangan_jurnal);
    create_jurnal2($kode_transaksi, $kode_kantor2, $coa_kredit, $nominal, 'kredit', $keterangan, $keterangan_jurnal);
    create_jurnal2($kode_transaksi, $kode_kantor2, $coa_debet2, $nominal, 'debet', $keterangan, $keterangan_jurnal);
    create_jurnal2($kode_transaksi, $kode_kantor2, $coa_kredit2, $nominal, 'kredit', $keterangan, $keterangan_jurnal);
}