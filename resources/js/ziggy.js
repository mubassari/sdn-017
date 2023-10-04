const Ziggy = {"url":"http:\/\/127.0.0.1:8000","port":8000,"defaults":{},"routes":{"index":{"uri":"\/","methods":["GET","HEAD"]},"admin.beranda":{"uri":"admin","methods":["GET","HEAD"]},"admin.artikel.index":{"uri":"admin\/artikel","methods":["GET","HEAD"]},"admin.artikel.tambah":{"uri":"admin\/artikel\/tambah","methods":["GET","HEAD"]},"admin.artikel.simpan":{"uri":"admin\/artikel","methods":["POST"]},"admin.artikel.ubah":{"uri":"admin\/artikel\/ubah\/{artikel}","methods":["GET","HEAD"],"bindings":{"artikel":"id"}},"admin.artikel.perbarui":{"uri":"admin\/artikel\/{artikel}","methods":["POST"],"bindings":{"artikel":"id"}},"admin.artikel.hapus":{"uri":"admin\/artikel\/{artikel}","methods":["DELETE"],"bindings":{"artikel":"id"}}}};

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };
