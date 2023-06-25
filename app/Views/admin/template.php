<!DOCTYPE html>
<html lang="en">

<?= $this->include('layout/header'); ?>

<body style="font-family: poppins;">

    <nav class="navbar fixed-top navbar-expand bg-white shadow">
        <div class="container-fluid px-5 d-flex justify-content-between">
            <a class="navbar-brand d-flex align-items-center gap-2" href="/">
                <img src="/assets/img/logo.png" alt="Logo" width="35" height="35" class="d-inline-block align-text-top">
                <span class="h4 m-0">Perpustakaanku</span>
            </a>

            <div class="nav navbar-nav">

                <div class="ms-auto dropdown">
                    <a class="text-decoration-none" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="true">
                        <div style="height: 45px; width: 170px;" class="row g-0">
                            <div class="text-dark text-nowrap wrap-text col-9 d-flex flex-column">
                                <small class="p-0 m-0">nama</small>
                                <small class="p-0 m-0">jabatan</small>
                            </div>
                            <div class="h-100 col-3 text-center">
                                <img style="object-fit: contain;" class="rounded-circle" height="40" width="40" src="/assets/img/logo.png" alt="">
                            </div>
                        </div>
                    </a>
                    <ul style="top: 50px;" class="dropdown-menu dropdown-menu-end" data-bs-popper="static">
                        <li><a class="dropdown-item"><i class="fa-regular fa-user"></i> Profile</a></li>
                        <li>
                            <hr class="dropdown-divider m-1">
                        </li>
                        <li>
                            <?php if (logged_in()) : ?>
                                <a class="dropdown-item" href="/logout"><i class="fa-regular fa-right-from-bracket"></i> Logout</a>
                            <?php else : ?>
                                <a class="dropdown-item" href="/login"><i class="fa-regular fa-arrow-right-from-bracket"></i> Login</a>
                            <?php endif ?>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </nav>


    <div class="d-flex" style="padding-top: 61px;">
        <div class="position-fixed bg-white vh-100 shadow pt-4 p-2 overflow-auto" style="width: 15rem;">

            <div class="side-content px-4 nav-pills">
                <div class="nav-item">
                    <a class="nav-link side-item p-3 gap-3 " href="/admin/dashboard">
                        <i class="fa-regular fa-house fs-5"></i> Dashboard
                    </a>
                </div>
            </div>

            <hr class="mt-3">

            <div class="accordion side-content" id="accordionExample">
                <div class="accordion-item border-0 ">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed rounded-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Data
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body pt-1">
                            <ul class="nav nav-pills flex-column gap-1">
                                <li class="nav-item ">
                                    <a class="nav-link side-item  gap-3 p-3" href="/admin/petugas"><i class="fa-regular fa-user-tie-hair fs-5"></i>Data Petugas</a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link side-item  gap-3 p-3" href="/admin/anggota"><i class="fa-regular fa-square-star fs-5"></i> Data Anggota</a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link side-item  gap-3 p-3" href="/admin/buku"><i class="fa-regular fa-book fs-5"></i> Data Buku</a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link side-item  gap-3 p-3" href="/admin/peminjaman"><i class="fa-regular fa-book-circle-arrow-right fs-5"></i>Data Peminjaman</a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link side-item  gap-3 p-3" href="/admin/pengembalian"><i class="fa-regular fa-book-circle-arrow-up fs-5"></i>Data Pengembalian</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-10 bg-light w-100" style="padding-left: 15rem;">
            <div class="container">
                <?= $this->renderSection('content'); ?>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores sunt aliquid autem ex nostrum labore ea culpa voluptatibus harum! Autem consequuntur ex odit aspernatur, saepe dignissimos. Necessitatibus veniam, pariatur voluptates enim aliquid adipisci debitis eligendi voluptatem laborum, inventore iste eaque laboriosam minus ipsa tenetur maxime harum dolores, ab sit eius quidem ea tempora! Corporis ipsa quibusdam dignissimos rerum reiciendis repudiandae quod doloribus! Nihil ipsam numquam fugit iusto odit quasi quibusdam consequatur temporibus distinctio minus? Aliquam quasi adipisci ut voluptates sit doloremque est, sed quo commodi dolore saepe eius velit, laborum sunt vel! Asperiores eius sequi facilis corporis dolore voluptate, rem eum! Consequatur eum libero iusto, vitae, praesentium optio natus sunt aspernatur alias dolor quidem eveniet odio ipsam. Id officiis, quae laudantium molestias voluptatibus totam? Laborum, ducimus fugit odit quam, exercitationem commodi nulla optio dolores inventore assumenda deleniti facere ipsum neque harum culpa perferendis dolor? Maxime cupiditate repellendus excepturi, consequatur fugit placeat! Asperiores magni enim iure nulla dolores, dolore accusamus harum eius molestiae voluptatibus quos praesentium laborum sunt iste, commodi doloribus, error voluptas numquam labore! Beatae explicabo ut maxime voluptate maiores doloremque, repellendus sunt omnis voluptatem minima temporibus optio error cum iusto? Ex exercitationem architecto explicabo? Ab fugiat sunt repudiandae, ex, exercitationem odit possimus similique vel corporis sequi modi assumenda magni, error ullam. Facere soluta impedit harum inventore animi itaque consequuntur sit! Nesciunt assumenda ipsam officia. Unde possimus itaque consequuntur cumque voluptas magni nostrum, voluptate ipsa molestias similique? Rem autem corporis quibusdam consequuntur itaque labore cupiditate ipsam rerum tempora totam. Alias, maxime. Alias neque at, voluptas maxime non, harum voluptates ratione omnis velit repudiandae reiciendis itaque nemo libero explicabo vel recusandae incidunt ea adipisci fugiat voluptatum aut perspiciatis veritatis! Dolores velit omnis eius atque fugiat odio animi ratione veritatis repellendus quidem. Culpa necessitatibus a quis amet ab est odit possimus dolor reprehenderit tempora iure deleniti repellat pariatur commodi veniam velit nihil ipsam quam voluptatum, fugit incidunt quo quas explicabo facere. Ratione minus expedita nihil quas id sit alias cumque. Atque, labore. Magnam saepe voluptates maiores facilis debitis earum doloribus impedit quibusdam vitae. Quasi fugiat praesentium, harum est nesciunt necessitatibus illo placeat illum assumenda dolorum optio. Ad perferendis, doloremque quibusdam dicta ipsam nulla error quae sapiente nostrum a officiis deserunt quia eos dolorum praesentium laudantium delectus illum omnis velit ipsa saepe fugiat, qui nam harum. Eum corporis, labore tenetur odio accusamus voluptatem saepe facilis asperiores consequuntur non ex cupiditate illo sequi provident iste architecto officia adipisci, numquam fugiat voluptate expedita. Quos consectetur asperiores consequuntur molestias aspernatur repellendus quia! Mollitia magni voluptates quisquam totam, ipsum veritatis assumenda sint sequi porro ex animi reiciendis pariatur error quam eius, provident est libero et voluptatem! Repellat, veniam corporis a aperiam qui asperiores illo fugiat ipsum necessitatibus tempora alias provident id assumenda quam sint aspernatur ad ut sed dolorem dolores? Perferendis atque nesciunt ipsa aperiam. Eius quas, optio ipsam sit dolorum fugiat ratione laboriosam obcaecati aut illum nemo, natus impedit quasi at fuga dignissimos fugit inventore asperiores officiis porro laborum! Vero vitae ipsum est incidunt inventore excepturi unde, optio officia, aspernatur id voluptatem? A magni dolore earum facere perspiciatis dolores enim magnam sunt dolorem recusandae laboriosam odit ipsam eos neque, ex quod corrupti accusantium autem soluta blanditiis aspernatur. Nostrum perspiciatis ratione facilis eaque ipsa aspernatur iusto voluptatum amet modi libero enim et fugiat culpa, consequatur ipsam rerum qui est nulla eum dignissimos. Omnis voluptas aut perspiciatis eligendi voluptatum error, numquam debitis unde corrupti odio veniam distinctio assumenda optio necessitatibus deserunt velit veritatis sit. Reiciendis aut, distinctio consequuntur a corporis pariatur fugit natus qui id ducimus nam necessitatibus ad facere laudantium quo consectetur eum reprehenderit quidem. Cumque saepe officiis veritatis voluptatibus fuga, laudantium vero, praesentium aspernatur iste ea rem repellat cupiditate libero omnis odio quisquam, corporis tempora alias ducimus aliquam. Provident animi doloribus quidem maiores ad sint aliquam placeat cum amet modi, corporis ab quos dicta autem! Inventore repudiandae, excepturi voluptatibus quo doloremque placeat explicabo obcaecati. Rerum atque beatae maxime non quaerat quasi fuga et voluptatem assumenda possimus maiores, quis adipisci veritatis optio totam exercitationem voluptates facilis, quod vero. Mollitia sunt fugit id est culpa cumque sed reiciendis aut consequuntur eius. Exercitationem, dolorem facere, eveniet veritatis adipisci in quis ex soluta expedita ad, dignissimos facilis? Vel ex assumenda debitis repudiandae ipsum iure id iste nobis sapiente sequi error enim, labore modi perferendis cumque inventore ullam quaerat? Similique illo fugiat autem cumque exercitationem fuga? Quis, quas eum autem voluptatem obcaecati est, earum voluptate nulla voluptates, quam distinctio dolorem. Quas nemo perferendis nam labore quidem necessitatibus quasi atque, maiores beatae architecto quibusdam dignissimos perspiciatis, laudantium consectetur modi ratione, magni laborum quam eos. Commodi, temporibus, magnam saepe est sapiente dolorum ea eum sed aspernatur quam architecto distinctio, ab odit delectus excepturi provident impedit. Voluptas, delectus est? Id, fuga! Facere obcaecati, nam corporis impedit, ipsum quas consequuntur laboriosam repellendus vel dolorum praesentium reprehenderit, molestias dolore incidunt saepe? Reiciendis velit corporis perferendis harum cumque, illo omnis, nostrum aperiam eum aut iste vitae tenetur quo rerum incidunt magnam esse dolorem asperiores magni! Qui dolor ipsam fugiat vero architecto dolorum, temporibus laboriosam quidem delectus libero culpa corporis. Facilis laborum nobis dignissimos molestiae ab consequuntur facere vero officiis a numquam tenetur nisi sit asperiores consequatur temporibus, qui dicta amet voluptatum sunt doloremque ad, porro corporis. Quas itaque rem magni nemo ea a doloremque nostrum odio voluptates, voluptas minus similique velit reprehenderit mollitia quam necessitatibus error atque, maiores, neque harum sunt fugit natus? Magnam facilis numquam similique repudiandae eum at impedit delectus! Dolorum amet dolore beatae vitae laborum mollitia voluptas. Eveniet assumenda natus ut, sapiente sint deleniti, adipisci qui iusto magni dolorem temporibus quidem vel possimus voluptatibus tenetur neque maxime, facere id unde quaerat ab. Eaque harum dignissimos recusandae eius laboriosam earum iste eligendi, facilis saepe cumque exercitationem nulla obcaecati architecto vero ullam pariatur consequatur dolore maiores cum veniam ex fuga soluta ipsam! Possimus odio ipsum aut quae pariatur reiciendis blanditiis, ipsa nulla voluptas commodi. Voluptate exercitationem facere repellendus dolorum, dolor, architecto laudantium ea, quos alias sint facilis? Odio, veritatis assumenda unde aperiam eius dolorem deserunt maiores.
            </div>
        </div>
    </div>

    <?= $this->include('layout/footer'); ?>
</body>

</html>