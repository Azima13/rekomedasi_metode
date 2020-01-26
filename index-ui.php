<?php

include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<?php

include './ui/partials/head.php';
?>

<body class="bg-gray-100 tracking-wider tracking-normal">
    <?php include 'ui/partials/navbar.php' ?>
    <!--Container-->
    <div class="container w-full flex flex-wrap mx-auto px-2 pt-8 lg:pt-16 mt-16">
        <div class="w-full lg:w-1/5 lg:px-6 text-xl text-gray-800 leading-normal">
            <p class="text-base font-bold py-2 lg:pb-6 text-gray-700">Menu</p>
            <div class="block lg:hidden sticky inset-0">
                <button id="menu-toggle" class="flex w-full justify-end px-3 py-3 bg-white lg:bg-transparent border rounded border-gray-600 hover:border-blue-500 appearance-none focus:outline-none">
                    <svg class="fill-current h-3 float-right" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg>
                </button>
            </div>
            <div class="w-full sticky inset-0 hidden h-64 lg:h-auto overflow-x-hidden overflow-y-auto lg:overflow-y-hidden lg:block mt-0 border border-gray-400 lg:border-transparent bg-white shadow lg:shadow-none lg:bg-transparent z-20" style="top:5em;" id="menu-content">
                <ul class="list-reset">
                    <li class="py-2 md:my-0 hover:bg-blue-100 lg:hover:bg-transparent">
                        <a href="#" class="block pl-4 align-middle text-gray-700 no-underline hover:text-blue-500 border-l-4 border-transparent lg:border-blue-500 lg:hover:border-blue-500">
                            <span class="pb-1 md:pb-0 text-sm text-gray-900 font-bold">Home</span>
                        </a>
                    </li>
                    <li class="py-2 md:my-0 hover:bg-blue-100 lg:hover:bg-transparent">
                        <a href="#" class="block pl-4 align-middle text-gray-700 no-underline hover:text-blue-500 border-l-4 border-transparent lg:hover:border-gray-400">
                            <span class="pb-1 md:pb-0 text-sm">Tasks</span>
                        </a>
                    </li>
                    <li class="py-2 md:my-0 hover:bg-blue-100 lg:hover:bg-transparent">
                        <a href="#" class="block pl-4 align-middle text-gray-700 no-underline hover:text-blue-500 border-l-4 border-transparent lg:hover:border-gray-400">
                            <span class="pb-1 md:pb-0 text-sm">Messages</span>
                        </a>
                    </li>
                    <li class="py-2 md:my-0 hover:bg-blue-100 lg:hover:bg-transparent">
                        <a href="#" class="block pl-4 align-middle text-gray-700 no-underline hover:text-blue-500 border-l-4 border-transparent lg:hover:border-gray-400">
                            <span class="pb-1 md:pb-0 text-sm">Analytics</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="w-full lg:w-4/5 p-8 mt-6 lg:mt-0 text-gray-900 leading-normal bg-white border border-gray-400 border-rounded">
            <!--Title-->
            <div class="font-sans">
                <span class="text-base text-blue-500 font-bold">&laquo;</span> <a href="#" class="text-base md:text-sm text-blue-500 font-bold no-underline hover:underline">Back Link</a>
                <h1 class="font-sans break-normal text-gray-900 pt-6 pb-2 text-xl">Help page title</h1>
                <hr class="border-b border-gray-400">
            </div>
            <!--Post Content-->
            <!--Lead Para-->
            <p class="py-6">
                👋 Welcome fellow <a class="text-blue-500 no-underline hover:underline" href="https://www.tailwindcss.com">Tailwind CSS</a> fan. This starter template provides a starting point to create your own helpdesk / faq / knowledgebase articles using Tailwind CSS and vanilla Javascript.

                <form method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 align-center">
                    <!-- menampilkan daftar Kriteria-->
                    <?php
                    $sqli = "SELECT id, code, name FROM ds_evidences ORDER BY code ASC ";
                    $result = $db->query($sqli);
                    while ($row = $result->fetch_object()) {
                        echo "<input type='checkbox' name='evidence[]' value='{$row->id}'"
                            . (isset($_POST['evidence']) ? (in_array($row->id, $_POST['evidence']) ? " checked" : "") : "")
                            . "> {$row->code} {$row->name}<br>";
                    }
                    ?>
                    <input type="submit" value="proses" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded m-4">
                </form>
                <pre>
<?php
//-- Mengambil Nilai Belief Kriteria Yang dipilih
if (isset($_POST['evidence'])) {
    if (count($_POST['evidence']) < 2) {
        echo "Pilih minimal 2 Kriteria";
    } else {
        $sql = "SELECT GROUP_CONCAT(b.code), a.cf
            FROM ds_rules a
            JOIN ds_problems b ON a.id_problem=b.id
            WHERE a.id_evidence IN(" . implode(',', $_POST['evidence']) . ")
            GROUP BY a.id_evidence";
        $result = $db->query($sql);
        $evidence = array();

        while ($row = $result->fetch_row()) {
            $evidence[] = $row;
        }

        //--- menentukan environement
        $sql = "SELECT GROUP_CONCAT(code) FROM ds_problems";
        $result = $db->query($sql);
        $row = $result->fetch_row();
        $fod = $row[0];

        //--- menentukan nilai densitas
        echo "<div class='font-bold text-xl mb-2 text-gray-700'>MENENTUKAN NILAI DENSITAS<div></div></div>";
        $densitas_baru = array();
        while (!empty($evidence)) {
            $densitas1[0] = array_shift($evidence);
            $densitas1[1] = array($fod, 1 - $densitas1[0][1]);
            $densitas2 = array();
            if (empty($densitas_baru)) {
                $densitas2[0] = array_shift($evidence);
            } else {
                foreach ($densitas_baru as $k => $r) {
                    if ($k != "&theta;") {
                        $densitas2[] = array($k, $r);
                    }
                }
            }
            $theta = 1;
            foreach ($densitas2 as $d) $theta -= $d[1];
            $densitas2[] = array($fod, $theta);
            $m = count($densitas2);
            $densitas_baru = array();
            for ($y = 0; $y < $m; $y++) {
                for ($x = 0; $x < 2; $x++) {
                    if (!($y == $m - 1 && $x == 1)) {
                        $v = explode(',', $densitas1[$x][0]);
                        $w = explode(',', $densitas2[$y][0]);
                        sort($v);
                        sort($w);
                        $vw = array_intersect($v, $w);
                        if (empty($vw)) {
                            $k = "&theta;";
                        } else {
                            $k = implode(',', $vw);
                        }
                        if (!isset($densitas_baru[$k])) {
                            $densitas_baru[$k] = $densitas1[$x][1] * $densitas2[$y][1];
                        } else {
                            $densitas_baru[$k] += $densitas1[$x][1] * $densitas2[$y][1];
                        }
                    }
                }
            }
            foreach ($densitas_baru as $k => $d) {
                if ($k != "&theta;") {
                    $densitas_baru[$k] = $d / (1 - (isset($densitas_baru["&theta;"]) ? $densitas_baru["&theta;"] : 0));
                }
            }
            print_r($densitas_baru);
        }

        //--- perangkingan
        echo "<div class='font-bold text-xl mb-2 text-gray-700'> PERANGKINGAN </div> \n";
        unset($densitas_baru["&theta;"]);
        arsort($densitas_baru);
        print_r($densitas_baru);

        //--- menampilkan hasil akhir
        echo "<div class='font-bold text-xl mb-2 text-gray-700'> HASIL AKHIR </div>\n";
        $codes = array_keys($densitas_baru);
        $final_codes = explode(',', $codes[0]);
        $sql = "SELECT GROUP_CONCAT(name) FROM ds_problems WHERE code IN('" . implode("','", $final_codes) . "')";
        $result = $db->query($sql);
        $row = $result->fetch_row();
        echo "<div class='p-2 bg-green-800 items-center text-green-100 leading-none lg:rounded-full flex lg:inline-flex' role='alert'>";
        echo "Terdeteksi Daerah Wisata <b>{$row[0]}</b> dengan derajat kepercayaan " . '<span class="font-semibold mr-2 text-left flex-auto">' . round($densitas_baru[$codes[0]] * 100, 2) . "%" . '</span>';
        echo "</div>";
    }
}

?>
            <!--/ Post Content-->
            <!-- Useful -->
            <hr class="border-b border-gray-400 py-4">
            <div class="flex items-center">
            </div>
            <!-- /Useful -->
         </div>
         <!--Back link -->
         <div class="w-full lg:w-4/5 lg:ml-auto text-base md:text-sm text-gray-500 px-4 py-6">
         </div>
      </div>
      <!--/container-->
      <footer class="bg-white border-t border-gray-400 shadow">
         <div class="container mx-auto flex py-8">
            <div class="w-full mx-auto flex flex-wrap">
               <div class="flex w-full lg:w-1/2 ">
                  <div class="px-8">
                     <h3 class="font-bold text-gray-900">About</h3>
                     <p class="py-4 text-gray-600 text-sm">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vel mi ut felis tempus commodo nec id erat. Suspendisse consectetur dapibus velit ut lacinia. 
                     </p>
                  </div>
               </div>
               <div class="flex w-full lg:w-1/2 lg:justify-end lg:text-right">
                  <div class="px-8">
                     <h3 class="font-bold text-gray-900">Social</h3>
                     <ul class="list-reset items-center text-sm pt-3">
                        <li>
                           <a class="inline-block text-gray-600 no-underline hover:text-gray-900 hover:underline py-1" href="#">Add social links</a>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </footer>
      <script src="./ui/js/utils.js"></script>
   </body>
</html>