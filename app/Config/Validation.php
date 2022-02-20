<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------
    // Login validation
    public $login = [
        'username' => [
            'rules' => 'required|min_length[5]',
            'errors' => [
                'required' => 'Username tidak boleh kosong',
                'min_length' => 'Username harus lebih dari atau sama dengan 5 karakter'
            ]
        ],
        'password' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Username tidak boleh kosong'
            ]
        ]
    ];

    public $createAdmin = [
        'username' => [
            'rules' => 'required|is_unique[user.username]',
            'errors' => [
                'required' => 'Username harus diisi',
                'is_unique' => 'Username sudah ada'
            ]
        ],
        'password' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Password harus diisi',
            ]
        ],
        '_password' => [
            'rules' => 'required|matches[password]',
            'errors' => [
                'required' => 'Password harus diisi',
                'matches' => 'Password tidak cocok'
            ]
        ],
        'gambar' => [
            'rules' => 'uploaded[gambar]|is_image[gambar]',
            'errors' => [
                'uploaded' => 'Gambar tidak boleh kosong',
                'is_image' => 'File harus berupa gambar',
            ]
        ]
    ];
    public $updateAdmin = [
        'username' => [
            'rules' => 'required|is_unique[user.username,id,{id}]',
            'errors' => [
                'required' => 'Username harus diisi',
                'is_unique' => 'Username sudah ada'
            ]
        ],
        'password' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Password harus diisi',
            ]
        ],
        '_password' => [
            'rules' => 'required|matches[password]',
            'errors' => [
                'required' => 'Password harus diisi',
                'matches' => 'Password tidak cocok'
            ]
        ],
    ];

    public $createUser = [
        'nama_lengkap' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama lengkap harus diisi',
            ]
        ],
        'no_hp' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'No hp harus diisi',
            ]
        ],
        'email' => [
            'rules' => 'required|valid_email',
            'errors' => [
                'required' => 'Email harus diisi',
                'valid_email' => 'Email tidak valid'
            ]
        ],
        'username' => [
            'rules' => 'required|is_unique[user.username]',
            'errors' => [
                'required' => 'Username harus diisi',
                'is_unique' => 'Username sudah ada'
            ]
        ],
        'password' => [
            'rules' => 'required|is_unique[user.username]',
            'errors' => [
                'required' => 'Password harus diisi',
                'is_unique' => 'Pengguna sudah terdaftar'
            ]
        ],
        '_password' => [
            'rules' => 'required|matches[password]',
            'errors' => [
                'required' => 'Password harus diisi',
                'matches' => 'Password tidak cocok'
            ]
        ],
        'gambar' => [
            'rules' => 'uploaded[gambar]|is_image[gambar]',
            'errors' => [
                'uploaded' => 'Gambar tidak boleh kosong',
                'is_image' => 'File harus berupa gambar',
            ]
        ]
    ];

    public $updateUser = [
        'id' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'User tidak valid',
            ]
        ],
        'username' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Username harus diisi',
            ]
        ],
        'password' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Password harus diisi',
            ]
        ],
        '_password' => [
            'rules' => 'required|matches[password]',
            'errors' => [
                'required' => 'Password harus diisi',
                'matches' => 'Password tidak cocok'
            ]
        ],
        'role' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Role harus diisi',
            ]
        ],

    ];

    public $createIklan = [
        'user_id' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'User tidak valid',
            ]
        ],
        'kategori_id' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Kategori tidak valid',
            ]
        ],
        'judul' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Judul harus diisi',
            ]
        ],
        'lokasi' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Lokasi harus diisi',
            ]
        ],
        'deskripsi' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Deskripsi harus diisi',
            ]
        ],
        'gambar' => [
            'rules' => 'uploaded[gambar]|is_image[gambar]',
            'errors' => [
                'uploaded' => 'Gambar tidak boleh kosong',
                'is_image' => 'File harus berupa gambar',
            ]
        ]
    ];
    public $updateIklan = [
        'id' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'ID tidak valid',
            ]
        ],
        'user_id' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'User tidak valid',
            ]
        ],
        'kategori_id' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Kategori tidak valid',
            ]
        ],
        'judul' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Judul harus diisi',
            ]
        ],
        'lokasi' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Lokasi harus diisi',
            ]
        ],
        'deskripsi' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Deskripsi harus diisi',
            ]
        ],
        'status' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Status harus diisi',
            ]
        ],
    ];

    public $createKategori = [
        'kategori' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama kategori harus diisi',
            ]
        ]
    ];

    public $updateKategori = [
        'id' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'ID tidak valid',
            ]
        ],
        'kategori' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama kategori harus diisi',
            ]
        ]
    ];

    public $createPenerbit = [
        'penerbit' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama penerbit harus diisi',
            ]
        ]
    ];
    public $updatePenerbit = [
        'penerbit' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama penerbit harus diisi',
            ]
        ]
    ];

    // penerbit_id
    // kategori_id
    // judul
    // penulis
    // berat
    // dimensi
    // bahasa
    // cover
    // ISBN
    // deskripsi
    // gambar

    public $createBuku = [
        'penerbit_id' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Penerbit tidak valid',
            ]
        ],
        'harga' => [
            'rules' => 'required|numeric',
            'errors' => [
                'required' => 'Harga tidak valid',
                'numeric' => 'Harga harus berupa angka',
            ]
        ],
        'kategori_id' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Kategori tidak valid',
            ]
        ],
        'judul' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Judul harus diisi',
            ]
        ],
        'penulis' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Penulis harus diisi',
            ]
        ],
        'berat' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Berat harus diisi',
            ]
        ],
        'dimensi' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Dimensi harus diisi',
            ]
        ],
        'bahasa' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Bahasa harus diisi',
            ]
        ],
        'cover' => [
            'rules' => 'required',
            'errors' => [
                'uploaded' => 'Cover tidak boleh kosong',
            ]
        ],
        'ISBN' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'ISBN harus diisi',
            ]
        ],
        'deskripsi' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Deskripsi harus diisi',
            ]
        ],
        'gambar' => [
            'rules' => 'uploaded[gambar]|is_image[gambar]',
            'errors' => [
                'uploaded' => 'Gambar tidak boleh kosong',
                'is_image' => 'File harus berupa gambar',
            ]
        ]
    ];

    public $updateBuku = [
        'penerbit_id' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Penerbit tidak valid',
            ]
        ],
        'kategori_id' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Kategori tidak valid',
            ]
        ],
        'judul' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Judul harus diisi',
            ]
        ],
        'penulis' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Penulis harus diisi',
            ]
        ],
        'berat' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Berat harus diisi',
            ]
        ],
        'dimensi' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Dimensi harus diisi',
            ]
        ],
        'bahasa' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Bahasa harus diisi',
            ]
        ],
        'cover' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Cover tidak boleh kosong',
            ]
        ],
        'ISBN' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'ISBN harus diisi',
            ]
        ],
        'deskripsi' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Deskripsi harus diisi',
            ]
        ],
    ];

    //     user_id
    // nama_lengkap
    // no_hp
    // email
    // alamat

    public $createPemesanan = [
        'user_id' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'User tidak valid',
            ]
        ],
        'nama_lengkap' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama lengkap harus diisi',
            ]
        ],
        'no_hp' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'No HP harus diisi',
            ]
        ],
        'email' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Email harus diisi',
            ]
        ],
        'alamat' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Alamat harus diisi',
            ]
        ],
    ];
    // pemesanan_id
    // status

    public $createStatusPembayaran = [
        'pemesanan_id' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Pemesanan tidak valid',
            ]
        ],
        'status' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Status harus diisi',
            ]
        ],
    ];
}
