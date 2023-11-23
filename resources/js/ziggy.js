const Ziggy = {"url":"http:\/\/127.0.0.1:8000","port":8000,"defaults":{},"routes":{"index":{"uri":"\/","methods":["GET","HEAD"]},"admin.index":{"uri":"admin","methods":["GET","HEAD"]},"admin.artikel.index":{"uri":"admin\/artikel","methods":["GET","HEAD"]},"admin.artikel.kategori.index":{"uri":"admin\/artikel\/kategori","methods":["GET","HEAD"]},"admin.artikel.kategori.simpan":{"uri":"admin\/artikel\/kategori","methods":["POST"]},"admin.artikel.kategori.perbarui":{"uri":"admin\/artikel\/kategori\/{kategori}","methods":["POST"],"bindings":{"kategori":"id"}},"admin.artikel.kategori.hapus":{"uri":"admin\/artikel\/kategori\/{kategori}","methods":["DELETE"],"bindings":{"kategori":"id"}},"admin.artikel.tambah":{"uri":"admin\/artikel\/tambah","methods":["GET","HEAD"]},"admin.artikel.simpan":{"uri":"admin\/artikel","methods":["POST"]},"admin.artikel.ubah":{"uri":"admin\/artikel\/ubah\/{artikel}","methods":["GET","HEAD"],"bindings":{"artikel":"id"}},"admin.artikel.perbarui":{"uri":"admin\/artikel\/{artikel}","methods":["POST"],"bindings":{"artikel":"id"}},"admin.artikel.hapus":{"uri":"admin\/artikel\/{artikel}","methods":["DELETE"],"bindings":{"artikel":"id"}},"admin.sekolah.index":{"uri":"admin\/sekolah","methods":["GET","HEAD"]},"admin.sekolah.simpan.umum":{"uri":"admin\/sekolah\/umum","methods":["POST"]},"admin.sekolah.simpan.sosmed":{"uri":"admin\/sekolah\/sosmed","methods":["POST"]},"admin.sekolah.simpan.lokasi":{"uri":"admin\/sekolah\/lokasi","methods":["POST"]},"admin.sambutan.index":{"uri":"admin\/sambutan","methods":["GET","HEAD"]},"admin.sambutan.simpan":{"uri":"admin\/sambutan\/simpan","methods":["POST"]},"admin.visi_misi_tujuan.index":{"uri":"admin\/visi-misi-tujuan","methods":["GET","HEAD"]},"admin.visi_misi_tujuan.simpanVisi":{"uri":"admin\/visi-misi-tujuan\/simpanVisi","methods":["POST"]},"admin.visi_misi_tujuan.simpanMisi":{"uri":"admin\/visi-misi-tujuan\/simpanMisi","methods":["POST"]},"admin.visi_misi_tujuan.simpanTujuan":{"uri":"admin\/visi-misi-tujuan\/simpanTujuan","methods":["POST"]},"admin.gtk.index":{"uri":"admin\/gtk","methods":["GET","HEAD"]},"admin.gtk.jabatan.index":{"uri":"admin\/gtk\/jabatan","methods":["GET","HEAD"]},"admin.gtk.jabatan.simpan":{"uri":"admin\/gtk\/jabatan","methods":["POST"]},"admin.gtk.jabatan.perbarui":{"uri":"admin\/gtk\/jabatan\/{jabatan}","methods":["POST"],"bindings":{"jabatan":"id"}},"admin.gtk.jabatan.hapus":{"uri":"admin\/gtk\/jabatan\/{jabatan}","methods":["DELETE"],"bindings":{"jabatan":"id"}},"admin.gtk.tambah":{"uri":"admin\/gtk\/tambah","methods":["GET","HEAD"]},"admin.gtk.simpan":{"uri":"admin\/gtk","methods":["POST"]},"admin.gtk.ubah":{"uri":"admin\/gtk\/ubah\/{gtk}","methods":["GET","HEAD"],"bindings":{"gtk":"id"}},"admin.gtk.perbarui":{"uri":"admin\/gtk\/{gtk}","methods":["POST"],"bindings":{"gtk":"id"}},"admin.gtk.hapus":{"uri":"admin\/gtk\/{gtk}","methods":["DELETE"],"bindings":{"gtk":"id"}},"visi_misi_tujuan":{"uri":"visi-misi-tujuan","methods":["GET","HEAD"]},"sambutan":{"uri":"sambutan","methods":["GET","HEAD"]},"artikel.index":{"uri":"{kategori}","methods":["GET","HEAD"]},"artikel.tampil":{"uri":"{kategori}\/{artikel}","methods":["GET","HEAD"]}}};

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };
