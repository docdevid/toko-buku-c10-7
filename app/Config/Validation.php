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
}