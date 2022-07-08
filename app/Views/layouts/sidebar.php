<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">OMITS 15<sup>th</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <?php
    $menu = [
        // 'item' => ['judul', 'link', 'ikon']
        'Admin'    =>    [
            ['Dashboard', 'dashboard/admin', 'fas fa-fw fa-tachometer-alt'],
            ['List User', 'dashboard/listUser', 'fas fa-fw fa-users'],
        ],
        'Peserta'   =>  [
            ['Dashboard', 'dashboard', 'fas fa-fw fa-tachometer-alt'],
            ['Edit Profil', 'dashboard/edit', 'fas fa-fw fa-user-edit'],
            ['Ubah Password', 'dashboard/ubahPassword', 'fas fa-fw fa-key'],
        ],
        'Pembayaran'    =>  [
            ['Petunjuk Pembayaran', 'pembayaran', 'fas fa-fw fa-file-invoice-dollar'],
            ['Upload Bukti Bayar', 'pembayaran/bukti', 'fas fa-handshake']
        ]
    ];
    if (session('role_id') != 1) {
        unset($menu['Admin']);
    }

    foreach ($menu as $key => $item) :
    ?>

    <!-- Heading -->
    <div class="sidebar-heading">
        <?= $key ?>
    </div>
        <?php foreach ($item as $value): ?>
    <li class="nav-item <?= $title == $value[0] ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= base_url($value[1]) ?>">
            <i class="<?= $value[2] ?>"></i>
            <span><?= $value[0] ?></span>
        </a>
    </li>
        <?php endforeach ?>
    <?php endforeach ?>
</ul>