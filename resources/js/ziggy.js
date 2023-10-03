const Ziggy = {"url":"http:\/\/127.0.0.1:8000","port":8000,"defaults":{},"routes":{"index":{"uri":"\/","methods":["GET","HEAD"]},"admin.beranda":{"uri":"admin","methods":["GET","HEAD"]},"admin.berita.index":{"uri":"admin\/berita","methods":["GET","HEAD"]},"admin.berita.tambah":{"uri":"admin\/berita\/tambah","methods":["GET","HEAD"]},"admin.berita.simpan":{"uri":"admin\/berita","methods":["POST"]},"admin.berita.ubah":{"uri":"admin\/berita\/ubah\/{berita}","methods":["GET","HEAD"],"bindings":{"berita":"id"}},"admin.berita.perbarui":{"uri":"admin\/berita\/{berita}","methods":["POST"],"bindings":{"berita":"id"}},"admin.berita.hapus":{"uri":"admin\/berita\/{berita}","methods":["DELETE"],"bindings":{"berita":"id"}}}};

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };
