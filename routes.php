<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
$route['home'] = "home";
$route['widget/covid-19'] = "home/widget";
$route['mapscovid'] = "home/mapscovid";
$route['404_override'] = 'notfoundpage';
$route['notfoundpage'] = 'notfoundpage';
$route['maintenance'] = 'maintenance';
$route['internal-server-error'] = 'notfoundpage/page500';
$route['gateway-timeout'] = 'notfoundpage/page504';
$route['newsletter'] = "newsletter";
$route['getnextarticle'] = "content/detailnext";
$route['newsletter/subscribe_banner'] = "newsletter/subscribe_banner";
$route['newsletter/cart'] = "newsletter/cart";
$route['newsletter/payment'] = "newsletter/payment_process"; 
$route['newsletter/payment/status'] = "newsletter/payment_status";
$route['getAllDataNext'] = "category/getAllDataNext";
$route['getAllDataNextLapsus'] = "category/getAllDataNextLapsus";
$route['getAllDataNextInside'] = "category/getAllDataNextInside";
$route['getAllDataNextDatablog'] = "analisisdata/getAllDataNextDatablog";
$route['getAllDataNextTopic'] = "topic/getAllDataNextTopic";
$route['getAllDataNextTags'] = "tags/getAllDataNextTags";

$route['analisisdata/(:num)/(:num)/(:num)/(:any)'] = "datablog/detail/$1/$2/$3/$4";
$route['berita/(:num)/(:num)/(:num)/(:any)'] = "content/detail/$1/$2/$3/$4";
$route['inside/(:num)/(:num)/(:num)/(:any)'] = "content/detailInside/$1/$2/$3/$4";
$route['telaah/(:num)/(:num)/(:num)/(:any)'] = "content/detail/$1/$2/$3/$4";
$route['infografik/(:num)/(:num)/(:num)/(:any)'] = "content/detail/$1/$2/$3/$4";
$route['grafik/(:num)/(:num)/(:num)/(:any)'] = "content/detail/$1/$2/$3/$4";
$route['opini/(:num)/(:num)/(:num)/(:any)'] = "content/detail/$1/$2/$3/$4";
$route['foto/(:num)/(:num)/(:num)/(:any)'] = "content/detail/$1/$2/$3/$4";
$route['video/(:num)/(:num)/(:num)/(:any)'] = "content/detail/$1/$2/$3/$4";
$route['analisis/(:num)/(:num)/(:num)/(:any)'] = "content/detail/$1/$2/$3/$4";
$route['riset-analisis/(:num)/(:num)/(:num)/(:any)'] = "content/detail/$1/$2/$3/$4";
$route['market-insight/(:num)/(:num)/(:num)/(:any)'] = "content/detail/$1/$2/$3/$4";
$route['buku/(:num)/(:num)/(:num)/(:any)'] = "content/detail/$1/$2/$3/$4";
$route['laporan/(:num)/(:num)/(:num)/(:any)'] = "content/detail/$1/$2/$3/$4";
$route['articles/(:num)/(:num)/(:num)/(:any)'] = "content/detailnew/$1/$2/$3/$4";
$route['oceansummit-news/(:num)/(:num)/(:num)/(:any)'] = "content/detail/$1/$2/$3/$4";
$route['oceansummit-ekongrafik/(:num)/(:num)/(:num)/(:any)'] = "content/detail/$1/$2/$3/$4";

$route['analisisdata/(:num)/(:num)/(:num)/(:any)/(:num)'] = "datablog/detail/$1/$2/$3/$4/$5";
$route['berita/(:num)/(:num)/(:num)/(:any)/(:num)'] = "content/detail/$1/$2/$3/$4/$5";
$route['telaah/(:num)/(:num)/(:num)/(:any)/(:num)'] = "content/detail/$1/$2/$3/$4/$5";
$route['infografik/(:num)/(:num)/(:num)/(:any)/(:num)'] = "content/detail/$1/$2/$3/$4/$5";
$route['grafik/(:num)/(:num)/(:num)/(:any)/(:num)'] = "content/detail/$1/$2/$3/$4/$5";
$route['opini/(:num)/(:num)/(:num)/(:any)/(:num)'] = "content/detail/$1/$2/$3/$4/$5";
$route['foto/(:num)/(:num)/(:num)/(:any)/(:num)'] = "content/detail/$1/$2/$3/$4/$5";
$route['video/(:num)/(:num)/(:num)/(:any)/(:num)'] = "content/detail/$1/$2/$3/$4/$5";
$route['analisis/(:num)/(:num)/(:num)/(:any)/(:num)'] = "content/detail/$1/$2/$3/$4/$5";
$route['riset-analisis/(:num)/(:num)/(:num)/(:any)/(:num)'] = "content/detail/$1/$2/$3/$4/$5";
$route['market-insight/(:num)/(:num)/(:num)/(:any)/(:num)'] = "content/detail/$1/$2/$3/$4/$5";
$route['buku/(:num)/(:num)/(:num)/(:any)/(:num)'] = "content/detail/$1/$2/$3/$4/$5";
$route['laporan/(:num)/(:num)/(:num)/(:any)/(:num)'] = "content/detail/$1/$2/$3/$4/$5";
$route['articles/(:num)/(:num)/(:num)/(:any)/(:num)'] = "content/detailnew/$1/$2/$3/$4/$5";
$route['oceansummit-news/(:num)/(:num)/(:num)/(:any)/(:num)'] = "content/detail/$1/$2/$3/$4/$5";
$route['oceansummit-ekongrafik/(:num)/(:num)/(:num)/(:any)/(:num)'] = "content/detail/$1/$2/$3/$4/$5";
$route['cakrawala/(:num)/(:num)/(:num)/(:any)'] = "content/detail/$1/$2/$3/$4";
$route['bola/(:num)/(:num)/(:num)/(:any)'] = "content/detail/$1/$2/$3/$4";

//revamp
$route['(:any)/analisisdata/(:any)/(:any)'] = "datablog/detail_v3/$1/$2/$3";
$route['(:any)/berita/(:any)/(:any)'] = "artikel/detail/$1/$2/$3";
$route['(:any)/energi/(:any)/(:any)'] = "artikel/detail/$1/$2/$3";
$route['(:any)/digital/(:any)/(:any)'] = "artikel/detail/$1/$2/$3";
$route['(:any)/finansial/(:any)/(:any)'] = "artikel/detail/$1/$2/$3";
$route['(:any)/infografik/(:any)/(:any)'] = "artikel/detail/$1/$2/$3";
$route['(:any)/video/(:any)/(:any)'] = "artikel/detail/$1/$2/$3";
$route['(:any)/indepth/(:any)/(:any)'] = "artikel/detail/$1/$2/$3";
$route['(:any)/laporan/(:any)/(:any)'] = "artikel/detail/$1/$2/$3";
$route['(:any)/cakrawala/(:any)/(:any)'] = "artikel/detail/$1/$2/$3";
$route['(:any)/bola/(:any)/(:any)'] = "artikel/detail/$1/$2/$3";
$route['(:any)/foto/(:any)/(:any)'] = "artikel/detail/$1/$2/$3";
$route['(:any)/analisis/(:any)/(:any)'] = "artikel/detail/$1/$2/$3";
$route['(:any)/ekonomi-hijau/(:any)/(:any)'] = "artikel/detail/$1/$2/$3";
$route['(:any)/brand/(:any)/(:any)'] = "artikel/detail/$1/$2/$3";
$route['(:any)/ekonopedia/(:any)/(:any)'] = "artikel/detail/$1/$2/$3";
$route['(:any)/podcast/(:any)/(:any)'] = "artikel/detail/$1/$2/$3";

$route['(:any)/analisisdata/(:any)/(:any)/(:num)'] = "datablog/detail_v3/$1/$2/$3/$4";
$route['(:any)/berita/(:any)/(:any)/(:num)'] = "artikel/detail/$1/$2/$3/$4";
$route['(:any)/energi/(:any)/(:any)/(:num)'] = "artikel/detail/$1/$2/$3/$4";
$route['(:any)/digital/(:any)/(:any)/(:num)'] = "artikel/detail/$1/$2/$3/$4";
$route['(:any)/finansial/(:any)/(:any)/(:num)'] = "artikel/detail/$1/$2/$3/$4";
$route['(:any)/infografik/(:any)/(:any)/(:num)'] = "artikel/detail/$1/$2/$3/$4";
$route['(:any)/video/(:any)/(:any)/(:num)'] = "artikel/detail/$1/$2/$3/$4";
$route['(:any)/indepth/(:any)/(:any)/(:num)'] = "artikel/detail/$1/$2/$3/$4";
$route['(:any)/laporan/(:any)/(:any)/(:num)'] = "artikel/detail/$1/$2/$3/$4";
$route['(:any)/cakrawala/(:any)/(:any)/(:num)'] = "artikel/detail/$1/$2/$3/$4";
$route['(:any)/bola/(:any)/(:any)/(:num)'] = "artikel/detail/$1/$2/$3/$4";
$route['(:any)/foto/(:any)/(:any)/(:num)'] = "artikel/detail/$1/$2/$3/$4";
$route['(:any)/analisis/(:any)/(:any)/(:num)'] = "artikel/detail/$1/$2/$3/$4";
$route['(:any)/ekonomi-hijau/(:any)/(:any)/(:num)'] = "artikel/detail/$1/$2/$3/$4";
$route['(:any)/brand/(:any)/(:any)/(:num)'] = "artikel/detail/$1/$2/$3/$4";
$route['(:any)/ekonopedia/(:any)/(:any)/(:num)'] = "artikel/detail/$1/$2/$3/$4";
$route['(:any)/podcast/(:any)/(:any)/(:num)'] = "artikel/detail/$1/$2/$3/$4";
//end revamp

// amp
$route['amp'] = "amp";
$route['amp/detail/(:any)'] = "amp_content/detail/$1";
$route['amp/berita/(:num)/(:num)/(:num)/(:any)'] = "amp_content/detail/$1/$2/$3/$4";
$route['amp/analisis/(:num)/(:num)/(:num)/(:any)'] = "amp_content/detail/$1/$2/$3/$4";
$route['amp/en/news/(:num)/(:num)/(:num)/(:any)'] = "amp_content/detail/$1/$2/$3/$4";
$route['amp/en/infografik/(:num)/(:num)/(:num)/(:any)'] = "amp_content/detail/$1/$2/$3/$4";
$route['amp/foto/(:num)/(:num)/(:num)/(:any)'] = "amp_content/detail/$1/$2/$3/$4";
$route['amp/video/(:num)/(:num)/(:num)/(:any)'] = "amp_content/detail/$1/$2/$3/$4";
$route['amp/infografik/(:num)/(:num)/(:num)/(:any)'] = "amp_content/detail/$1/$2/$3/$4";
$route['amp/grafik/(:num)/(:num)/(:num)/(:any)'] = "amp_content/detail/$1/$2/$3/$4";
$route['amp/opini/(:num)/(:num)/(:num)/(:any)'] = "amp_content/detail/$1/$2/$3/$4";
$route['amp/telaah/(:num)/(:num)/(:num)/(:any)'] = "amp_content/detail/$1/$2/$3/$4";
$route['amp/riset-analisis/(:num)/(:num)/(:num)/(:any)'] = "amp_content/detail/$1/$2/$3/$4";
$route['amp/market-insight/(:num)/(:num)/(:num)/(:any)'] = "amp_content/detail/$1/$2/$3/$4";
$route['amp/buku/(:num)/(:num)/(:num)/(:any)'] = "amp_content/detail/$1/$2/$3/$4";
$route['amp/laporan/(:num)/(:num)/(:num)/(:any)'] = "amp_content/detail/$1/$2/$3/$4";
$route['amp/news/(:num)/(:num)/(:num)/(:any)'] = "amp_content/detail/$1/$2/$3/$4";
$route['amp/econographics/(:num)/(:num)/(:num)/(:any)'] = "amp_content/detail/$1/$2/$3/$4";
$route['amp/opinion/(:num)/(:num)/(:num)/(:any)'] = "amp_content/detail/$1/$2/$3/$4";
$route['amp/in-depth/(:num)/(:num)/(:num)/(:any)'] = "amp_content/detail/$1/$2/$3/$4";
$route['amp/articles/(:num)/(:num)/(:num)/(:any)'] = "amp_content/detailnew/$1/$2/$3/$4";
$route['amp/detailinfomark/(:num)/(:num)/(:num)/(:any)'] = "amp_content/detailinfomark/$1/$2/$3/$4";
$route['amp/cakrawala/(:num)/(:num)/(:num)/(:any)'] = "amp_content/detail/$1/$2/$3/$4";
$route['amp/ekonomi-hijau/(:num)/(:num)/(:num)/(:any)'] = "amp_content/detail/$1/$2/$3/$4";
$route['amp/brand/(:num)/(:num)/(:num)/(:any)'] = "amp_content/detail/$1/$2/$3/$4";
$route['amp/ekonopedia/(:num)/(:num)/(:num)/(:any)'] = "amp_content/detail/$1/$2/$3/$4";

$route['amp/berita/(:num)/(:num)/(:num)/(:any)/(:num)'] = "amp_content/detail/$1/$2/$3/$4/$5";
$route['amp/telaah/(:num)/(:num)/(:num)/(:any)/(:num)'] = "amp_content/detail/$1/$2/$3/$4/$5";
$route['amp/infografik/(:num)/(:num)/(:num)/(:any)/(:num)'] = "amp_content/detail/$1/$2/$3/$4/$5";
$route['amp/grafik/(:num)/(:num)/(:num)/(:any)/(:num)'] = "amp_content/detail/$1/$2/$3/$4/$5";
$route['amp/opini/(:num)/(:num)/(:num)/(:any)/(:num)'] = "amp_content/detail/$1/$2/$3/$4/$5";
$route['amp/foto/(:num)/(:num)/(:num)/(:any)/(:num)'] = "amp_content/detail/$1/$2/$3/$4/$5";
$route['amp/video/(:num)/(:num)/(:num)/(:any)/(:num)'] = "amp_content/detail/$1/$2/$3/$4/$5";
$route['amp/riset-analisis/(:num)/(:num)/(:num)/(:any)/(:num)'] = "amp_content/detail/$1/$2/$3/$4/$5";
$route['amp/market-insight/(:num)/(:num)/(:num)/(:any)/(:num)'] = "amp_content/detail/$1/$2/$3/$4/$5";
$route['amp/buku/(:num)/(:num)/(:num)/(:any)/(:num)'] = "amp_content/detail/$1/$2/$3/$4/$5";
$route['amp/laporan/(:num)/(:num)/(:num)/(:any)/(:num)'] = "amp_content/detail/$1/$2/$3/$4/$5";
$route['amp/news/(:num)/(:num)/(:num)/(:any)/(:num)'] = "amp_content/detail/$1/$2/$3/$4/$5";
$route['amp/econographics/(:num)/(:num)/(:num)/(:any)/(:num)'] = "amp_content/detail/$1/$2/$3/$4/$5";
$route['amp/in-depth/(:num)/(:num)/(:num)/(:any)/(:num)'] = "amp_content/detail/$1/$2/$3/$4/$5";
$route['amp/articles/(:num)/(:num)/(:num)/(:any)/(:num)'] = "amp_content/detailnew/$1/$2/$3/$4/$5";
$route['amp/detailinfomark/(:num)/(:num)/(:num)/(:any)/(:num)'] = "amp_content/detailinfomark/$1/$2/$3/$4/$5";
$route['amp/cakrawala/(:num)/(:num)/(:num)/(:any)/(:num)'] = "amp_content/detail/$1/$2/$3/$4/$5";
$route['amp/ekonomi-hijau/(:num)/(:num)/(:num)/(:any)/(:num)'] = "amp_content/detail/$1/$2/$3/$4/$5";
$route['amp/brand/(:num)/(:num)/(:num)/(:any)/(:num)'] = "amp_content/detail/$1/$2/$3/$4/$5";
$route['amp/ekonopedia/(:num)/(:num)/(:num)/(:any)/(:num)'] = "amp_content/detail/$1/$2/$3/$4/$5";
// end amp

//amp revamp
$route['amp/(:any)/berita/(:any)/(:any)'] = "amp_content/detailv3/$1/$2/$3";
$route['amp/(:any)/energi/(:any)/(:any)'] = "amp_content/detailv3/$1/$2/$3";
$route['amp/(:any)/digital/(:any)/(:any)'] = "amp_content/detailv3/$1/$2/$3";
$route['amp/(:any)/finansial/(:any)/(:any)'] = "amp_content/detailv3/$1/$2/$3";
$route['amp/(:any)/infografik/(:any)/(:any)'] = "amp_content/detailv3/$1/$2/$3";
$route['amp/(:any)/video/(:any)/(:any)'] = "amp_content/detailv3/$1/$2/$3";
$route['amp/(:any)/indepth/(:any)/(:any)'] = "amp_content/detailv3/$1/$2/$3";
$route['amp/(:any)/laporan/(:any)/(:any)'] = "amp_content/detailv3/$1/$2/$3";
$route['amp/(:any)/cakrawala/(:any)/(:any)'] = "amp_content/detailv3/$1/$2/$3";
$route['amp/(:any)/bola/(:any)/(:any)'] = "amp_content/detailv3/$1/$2/$3";
$route['amp/(:any)/foto/(:any)/(:any)'] = "amp_content/detailv3/$1/$2/$3";
$route['amp/(:any)/ekonomi-hijau/(:any)/(:any)'] = "amp_content/detailv3/$1/$2/$3";
$route['amp/(:any)/brand/(:any)/(:any)'] = "amp_content/detailv3/$1/$2/$3";
$route['amp/(:any)/analisis/(:any)/(:any)'] = "amp_content/detailv3/$1/$2/$3";
$route['amp/(:any)/ekonopedia/(:any)/(:any)'] = "amp_content/detailv3/$1/$2/$3";
$route['amp/(:any)/podcast/(:any)/(:any)'] = "amp_content/detailv3/$1/$2/$3";

$route['amp/(:any)/berita/(:any)/(:any)/(:num)'] = "amp_content/detailv3/$1/$2/$3/$4";
$route['amp/(:any)/energi/(:any)/(:any)/(:num)'] = "amp_content/detailv3/$1/$2/$3/$4";
$route['amp/(:any)/digital/(:any)/(:any)/(:num)'] = "amp_content/detailv3/$1/$2/$3/$4";
$route['amp/(:any)/finansial/(:any)/(:any)/(:num)'] = "amp_content/detailv3/$1/$2/$3/$4";
$route['amp/(:any)/infografik/(:any)/(:any)/(:num)'] = "amp_content/detailv3/$1/$2/$3/$4";
$route['amp/(:any)/video/(:any)/(:any)/(:num)'] = "amp_content/detailv3/$1/$2/$3/$4";
$route['amp/(:any)/indepth/(:any)/(:any)/(:num)'] = "amp_content/detailv3/$1/$2/$3/$4";
$route['amp/(:any)/laporan/(:any)/(:any)/(:num)'] = "amp_content/detailv3/$1/$2/$3/$4";
$route['amp/(:any)/cakrawala/(:any)/(:any)/(:num)'] = "amp_content/detailv3/$1/$2/$3/$4";
$route['amp/(:any)/bola/(:any)/(:any)/(:num)'] = "amp_content/detailv3/$1/$2/$3/$4";
$route['amp/(:any)/foto/(:any)/(:any)/(:num)'] = "amp_content/detailv3/$1/$2/$3/$4";
$route['amp/(:any)/ekonomi-hijau/(:any)/(:any)/(:num)'] = "amp_content/detailv3/$1/$2/$3/$4";
$route['amp/(:any)/brand/(:any)/(:any)/(:num)'] = "amp_content/detailv3/$1/$2/$3/$4";
$route['amp/(:any)/analisis/(:any)/(:any)/(:num)'] = "amp_content/detailv3/$1/$2/$3/$4";
$route['amp/(:any)/ekonopedia/(:any)/(:any)/(:num)'] = "amp_content/detailv3/$1/$2/$3/$4";
$route['amp/(:any)/podcast/(:any)/(:any)/(:num)'] = "amp_content/detailv3/$1/$2/$3/$4";

//end amp revamp

$route['indeks'] = "indeks";
$route['contact'] = "contactus/mail";
$route['hubungi-kami'] = "contactus/mail";
$route['indeks/listing'] = "indeks/listing";
$route['indeks/listing/(:num)'] = "indeks/listing/$1";
$route['indeks/search/(:any)'] = "indeks/search/$1";
$route['indeks/search/(:any)/(:any)/(:any)/(:any)/(:any)'] = "indeks/search/$1/$2/$3/$4/$5";
$route['search/cse/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = "search/listing/cse/$1/$2/$3/$4/$5/$6/$7";
$route['search/cse/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = "search/listing/cse/$1/$2/$3/$4/$5/$6/$7/$8";
$route['halaman/(:any)/(:any)'] = "halaman/detailpagebottom/$1/$2";
$route['tentang-katadata'] = "halaman/detailpagebottom/7/tentang-katadata";
$route['pedoman-media-siber'] = "halaman/detailpagebottom/12/pedoman-media-siber";
$route['produk-katadata'] = "halaman/detailpagebottom/14/produk-katadata";
// $route['profil/getAllData/(:any)'] = "profil/getAllData/$1/0";
// $route['profil/getAllData/(:any)/(:any)'] = "profil/getAllData/$1/$2";
// $route['profil/searchdata/(:any)/(:any)'] = "profil/searchdata/$1/$2";
// $route['profil/(:any)'] = "profil/listing/$1";
$route['embedchart/(:any)'] = "embedchart/detail/$1";
$route['resend_activation'] = "resend_activation";
$route['resend_activation/post_res'] = "resend_activation/post_res";
$route['resetpass'] = "resetpass";
$route['resetpass/post_res'] = "resetpass/post_res";
// $route['login'] = "login";
// $route['register'] = "register";
// $route['logout'] = "login/logout";
// $route['fb'] = "fb/login";
// $route['fb/login'] = "fb/login";
// $route['fb/redirectfblogin'] = "fb/redirectfblogin";
// $route['fb/redirectfblogout'] = "fb/redirectfblogout";
// $route['fb/registerfb'] = "fb/registerfb";
// $route['fb/successregisterfb'] = "fb/successregisterfb";
// $route['linkedin/login'] = "linkedin/login";
// $route['linkedin/redirect_linkedin'] = "linkedin/redirect_linkedin";
// $route['linkedin/successregisterlinkedin'] = "linkedin/successregisterlinkedin";
// $route['register/(:any)'] = "register/post_reg";
$route['activate/doactivate/(:any)'] = "activate/doactivate/$1";
$route['activate/reset_pass/(:any)'] = "activate/reset_pass/$1";
$route['user/account'] = "user/account";
$route['user/alert'] = "user/warning";
$route['user/analisis'] = "user/analisis";
$route['user/analisis/(:any)'] = "user/analisis/$1";
$route['user/messages'] = "user/message";
$route['user/messages/(:any)'] = "user/message/$1";
$route['user/collection'] = "user/collection";
$route['user/changepassword'] = "user/changepassword";
$route['user/addartikel'] = "user/addartikel";
$route['user/editartikel/(:num)'] = "user/editartikel/$1";
$route['user/editaccount'] = "user/editaccount";
$route['user/collection/(:any)'] = "user/collection/$1";
$route['user/deleteThisArtikel'] = "user/deleteThisArtikel";
$route['topics/(:any)'] = "topic/listing/$1";
// $route['getAllDataNextTags'] = "tags/getAllDataNext"; sudah ada diatas
$route['getAllDataNextSpecial'] = "tags/getAllDataNextSpecial";
$route['getAllDataNextSearchErp'] = "tags/getAllDataNextSearchErp";
$route['getAllDataNextSearchEcf'] = "tags/getAllDataNextSearchEcf";
$route['magazine/(:any)/(:any)'] = "magazine/detail/$1/$2";
$route['tags/getAllData/(:any)'] = "tags/getAllData/$1/0";
$route['tags/getAllData/(:any)/(:any)'] = "tags/getAllData/$1/$2";
$route['tags/searchdata/(:any)/(:any)'] = "tags/searchdata/$1/$2";
$route['tags/searchdataErp/(:any)'] = "tags/searchdataErp/$1";
$route['tags/searchdataEcf/(:any)'] = "tags/searchdataEcf/$1";
$route['tags/getAllDataDataboks/(:any)'] = "tags/getAllDataDataboks/$1/0";
$route['tags/getAllDataDataboks/(:any)/(:any)'] = "tags/getAllDataDataboks/$1/$2";
$route['tags/(:any)'] = "tags/listing/$1";
$route['katadata6'] = "hut_katadata/index_katadata6";
$route['katadata6/detail'] = "hut_katadata/detail_katadata6";

$route['feed/berita_terkini/(:any)/(:any)'] = "feed/berita_terkini/$1/$2";
$route['feed/berita_terkinilinetoday/(:any)/(:any)'] = "feed/berita_terkinilinetoday/$1/$2";
$route['feed/berita_terkini_1/(:any)/(:any)'] = "feed/berita_terkini_1/$1/$2";
$route['feed/berita_terkini_fb/(:any)/(:any)'] = "feed/berita_terkini_fb/$1/$2";
$route['feed/berita_terpopuler/(:any)/(:any)'] = "feed/berita_terpopuler/$1/$2";
$route['feed/berita_terpopuler_1/(:any)/(:any)'] = "feed/berita_terpopuler_fb/$1/$2";
$route['feed/berita_terpopuler_fb/(:any)/(:any)'] = "feed/berita_terpopuler_1/$1/$2";
$route['feed/infografik_terkini/(:any)/(:any)'] = "feed/infografik_terkini/$1/$2";
$route['feed/infografik_terkini_1/(:any)/(:any)'] = "feed/infografik_terkini_1/$1/$2";
$route['feed/infografik_terkini_fb/(:any)/(:any)'] = "feed/infografik_terkini_fb/$1/$2";
$route['feed/infografik_terpopuler/(:any)/(:any)'] = "feed/infografik_terpopuler/$1/$2";
$route['feed/infografik_terpopuler_1/(:any)/(:any)'] = "feed/infografik_terpopuler_1/$1/$2";
$route['feed/infografik_terpopuler_fb/(:any)/(:any)'] = "feed/infografik_terpopuler_fb/$1/$2";
$route['feed/grafik_terkini/(:any)/(:any)'] = "feed/grafik_terkini/$1/$2";
$route['feed/grafik_terkini_1/(:any)/(:any)'] = "feed/grafik_terkini_1/$1/$2";
$route['feed/grafik_terkini_fb/(:any)/(:any)'] = "feed/grafik_terkini_fb/$1/$2";
$route['feed/grafik_terpopuler/(:any)/(:any)'] = "feed/grafik_terpopuler/$1/$2";
$route['feed/grafik_terpopuler_1/(:any)/(:any)'] = "feed/grafik_terpopuler_1/$1/$2";
$route['feed/grafik_terpopuler_fb/(:any)/(:any)'] = "feed/grafik_terpopuler_fb/$1/$2";
$route['feed/today_article/(:any)/(:any)'] = "feed/today_article/$1/$2";
$route['feed/article-all/(:any)/(:any)'] = "feed/articleAll/$1/$2";
$route['feed/article-otomotif/(:any)/(:any)'] = "feed/articleOtomotif/$1/$2";
$route['feed/article-lifestyle/(:any)/(:any)'] = "feed/articleLifestyle/$1/$2";
$route['feed/list-video/(:any)/(:any)'] = "feed/video/$1/$2";
$route['feed/slide-show/(:any)/(:any)'] = "feed/slideshow/$1/$2";
$route['feed/list-infografik/(:any)/(:any)'] = "feed/infografik/$1/$2";
$route['feed/article-internasional/(:any)/(:any)'] = "feed/articleInternasional/$1/$2";
$route['feed/article-teknologi/(:any)/(:any)'] = "feed/articleTeknologi/$1/$2";

$route['multimedia'] = "multimedia";
$route['multimedia/foto'] = "multimedia/indexfoto";
$route['multimedia/video'] = "multimedia/indexvideo";
$route['disclaimer'] = "halaman/disclaimer";
$route['privacy'] = "halaman/privacy";
$route['kebijakan-privasi'] = "halaman/privacy";
$route['ketentuan-layanan'] = "halaman/ketentuanlayanan";
$route['webservice/(:any)'] = "webservice/$1";
$route['webservice/doPublish'] = "webservice/doPublish";
$route['webservice/doPublishDatastatistik'] = "webservice/doPublishDatastatistik";
$route['webservice/clearHolKlinik'] = "webservice/clearHolKlinik";
$route['webservice/info'] = "webservice/info";
$route['webservice/updateStatusLowongan'] = "webservice/updateStatusLowongan";
$route['kuis'] = "kuis";
$route['karier'] = "lowongan";
$route['karier2'] = "lowongan/index2";
$route['karier/detail/(:any)'] = "lowongan/detail/$1";
$route['karier/entrilamaran'] = "lowongan/entrilamaran";

## INDUCTION
$route['induction'] = "induction";

// $route['infomark'] = "infomark";
$route['info_lembaga'] = "infomark";
$route['info_lembaga/search/(:num)'] = "infomark/search/$1";
$route['info_daerah'] = "info_daerah";
$route['info_daerah/search/(:num)'] = "info_daerah/search/$1";
$route['info_perusahaan'] = "info_perusahaan";
$route['info_perusahaan/search/(:num)'] = "info_perusahaan/search/$1";
$route['infomark_landing'] = "infomark/infomark_landing";
$route['kuis/listing'] = "kuis/listing";
$route['kuis/listing/(:num)'] = "kuis/listing/$1";
$route['kuis/opener/(:num)/(:any)'] = "kuis/opener/$1/$2";
$route['kuis/detail/(:num)/(:any)'] = "kuis/detail/$1/$2";
$route['kuis/insert_answer'] = "kuis/insert_answer";
$route['kuis/insert_answer/(:num)'] = "kuis/insert_answer/$1";
$route['kuis/detail_answer/(:num)'] = "kuis/detail_answer/$1";
$route['kuis/detail_answer/(:any)/(:any)/(:any)'] = "kuis/detail_answer/$1/$2/$3";
$route['kuis/updateCountClick'] = "kuis/updateCountClick";
$route['datapublish/addtocollection'] = "datapublish/addtocollection";
$route['datapublish/viewlist/(:any)'] = "datapublish/viewlist/$1";
$route['datapublish/searchviewlist/(:any)/(:any)'] = "datapublish/searchviewlist/$1/$2";
$route['datapublish/searchviewlist/(:any)/(:any)/(:any)'] = "datapublish/searchviewlist/$1/$2/$3";
$route['datapublish/(:num)/(:num)/(:num)/(:any)'] = "datapublish/detail/$1/$2/$3/$4";
$route['datapublish/index'] = "datapublish/indexdatapublish/0";
$route['datapublish/index/(:num)'] = "datapublish/indexdatapublish/$1";
$route['datapublish/search/(:any)'] = "datapublish/search/$1";
$route['datapublish/search/(:any)/(:any)'] = "datapublish/search/$1/$2";
$route['analisis'] = "analisis";
// $route['analisisdata'] = "analisisdata";
$route['analisis/next'] = "analisis/getNextSearch";
$route['analisisdata/next'] = "analisisdata/getNextSearch";
$route['analisis/search/(:any)'] = "analisis/search/$1";
$route['analisisdata/search/(:any)'] = "analisisdata/search/$1";
$route['analisis/search/(:any)/(:num)'] = "analisis/search/$1/$2";
$route['analisisdata/search/(:any)/(:num)'] = "analisisdata/search/$1/$2";
$route['3-tahun-kkp'] = "tigatahunkkp";
$route['getAllDataNextInfomark'] = "infomark/getAllDataNextInfomark";
$route['3-tahun-jokowi-jk'] = "tigatahunjokowi";
$route['3-tahun-jokowi-jk/detail'] = "tigatahunjokowi/detail";
$route['special_report/getAllDataNextSpecial'] = "special_report/getAllDataNextSpecial";
$route['special_report/getAllData/(:any)'] = "special_report/getAllData/$1/0";
$route['special_report/getAllData/(:any)/(:any)'] = "special_report/getAllData/$1/$2";
$route['special_report'] = "special_report/listing/";
$route['go/(:num)'] = "artikel/go/$1";
$route['downloads/files/(:any)'] = "downloads/files/$1";
$route['downloads/sejarahekonomi'] = "downloads/sejarahekonomi";
$route['index_iklan'] = "home/index_iklan";

// investing woman
$route['investinginwomen'] = "investingwoman/index";
$route['investinginwomen_vlog'] = "iiwvlog/index";
$route['investinginwomen_vlog/tutorial'] = "iiwvlog/tutorial";
$route['investinginwomen_vlog/galeri'] = "iiwvlog/galeri";
$route['investinginwomen_vlog/galerinext'] = "iiwvlog/galerinext";
$route['investinginwomen_vlog/pemenang'] = "iiwvlog/pemenang";
// $route['investinginwomen_vlog/register'] = "iiwvlog/register";
$route['gender'] = "investingwoman/index";
// sitemap

$route['sitemap\.xml'] = "sitemap/index";
$route['sitemap-index\.xml'] = "sitemap/sitemap_index";
$route['sitemap-basic\.xml'] = "sitemap/sitemap_basic";
$route['sitemap-editor\.xml'] = "sitemap/sitemap_editor";
$route['sitemap-etalase\.xml'] = "sitemap/sitemap_etalase";
$route['sitemap-sub-etalase\.xml'] = "sitemap/sitemap_sub_etalase";
$route['sitemap-editor-kanal\.xml'] = "sitemap/sitemap_editor_kanal";
$route['sitemap-news\.xml'] = "sitemap/sitemap_news";
$route['sitemap-images\.xml'] = "sitemap/sitemap_images";
$route['sitemap-video\.xml'] = "sitemap/sitemap_video";
$route['sitemap-tags\.xml'] = "sitemap/sitemap_tags";
$route['(:any)\.xml'] = "sitemap/sitemap_post/$1/$2";

$route['generatesitemapindex'] = "sitemap/generateSitemapIndex";
$route['generatesitemapbasic'] = "sitemap/generateSitemapBasic";
$route['generatesitemapeditor'] = "sitemap/generateSitemapEditor";
$route['generatesitemapetalase'] = "sitemap/generateSitemapEtalase";
$route['generatesitemapsubetalase'] = "sitemap/generateSitemapSubEtalase";
$route['generatesitemapeditorkanal'] = "sitemap/generateSitemapEditorKanal";
$route['generatesitemapnews'] = "sitemap/generateSitemapNews";
$route['generatesitemapimages'] = "sitemap/generateSitemapImages";
$route['generatesitemapvideo'] = "sitemap/generateSitemapvideo";
$route['generatesitemaptags'] = "sitemap/generateSitemapTags";
$route['generatesitemappost/(:any)/(:any)'] = "sitemap/generateSitemapPost/$1/$2";

// produk
$route['produk'] = "produk";
$route['produk/order/(:any)/(:any)'] = "produk/order/$1/$2";
$route['produk/cart'] = "produk/cart";
$route['produk/payment'] = "produk/payment_process";
$route['produk/payment/status'] = "produk/payment_status";
$route['produk/payment/notification'] = "produk/payment_notification";
$route['produk/payment/notification-sandbox'] = "produk/payment_notification_sandbox";
$route['produk/payment_notification_xendit'] = "produk/payment_notification_xendit";

$route['sejarahekonomi'] = "sejarahekonomi";
$route['sejarahekonomi/history_download'] = "sejarahekonomi/history_download";
$route['newsletter/sample/(:any)'] = "newsletter/sample/$1";

$route['downloadform'] = "downloadform";
$route['downloadform/insertdownloadform'] = "downloadform/insertDownloadForm";
$route['content/detailfoto2'] = "content/detailfoto2";
$route['pusdatin'] = "pusdatin";
$route['pilpres-2019'] = "pilpres";

$route['getAllDataToday'] = "indeks/getAllDataToday";

$route['api/(:any)'] = "home/getHol/$1";
$route['pilpres-2019'] = "pilpres";
$route['pilpres-2019/sentiment'] = "pilpres/sentiment";
$route['pilpres-2019/quickcount'] = "pilpres/quickcount";
// $route['pilpres-2019/presentation'] = "pilpres/presentation";
$route['investigasi-batu-bara'] = "micrositebatubara";

$route['ekonomi-kreatif'] = "microsite_ekonomikreatif";
$route['pariwisata'] = "microsite_ekonomikreatif/index2";
$route['ketenagakerjaan'] = "microsite_kemnaker";
$route['kebakaran-gambut'] = "microsite_kebakaran";
$route['airy'] = "microsite_airy";
$route['kelola-sampah'] = "microsite_sampah";
$route['moratorium-sawit'] = "microsite_moratorium";
$route['cashless'] = "microsite_cashless";
$route['kajian-biodiesel'] = "microsite_biodiesel";
$route['outlook-2020'] = "microsite_outlook";
$route['ide-katadata-2020'] = "microsite_konten_ide";
$route['ide-katadata-2022'] = "microsite_konten_ide/ide2022";
$route['karhutla'] = "microsite_karhutla";
$route['green-papua-2021'] = "microsite_green_papua";
$route['kajian-lcdi'] = "microsite_lcdi";
// $route['bola'] = "microsite_bola";
// $route['bola/getAllDataNext'] = "microsite_bola/getAllDataNext";


// Kanal Cakrawala
$route['cakrawala'] = "subkanal/listing/$1";
$route['cakrawala/(:any)'] = "penulis/guest/$1";
$route['cakrawala/next_data/(:num)/(:any)'] = "kanal_cakrawala/getNextData/$1/$2";
$route['cakrawala/(:any)/next_data/(:num)'] = "kanal_cakrawala/getNextData/$1/$2";
// $route['cakrawala/(:any)/(:any)/(:any)/(:any)'] = "kanal_cakrawala/detail/$1/$2/$3/$4";
 
## ide2020
$route['ide2020'] = "microsite_ide";
$route['IDE2020'] = "microsite_ide";
$route['ide2020/download'] = "microsite_ide/download_page";
// $route['event'] = "microsite_ide/landing_page";
// $route['event/pastevent'] = "microsite_ide/past_event";
// $route['event/(:any)'] = "microsite_ide/detail/$1";
// $route['event/pastevent/(:any)'] = "microsite_ide/detail/$1";

## ide2021
$route['ide2021'] = "microsite_ide/ide2021";
$route['IDE2021'] = "microsite_ide/ide2021";

## ide2022
$route['ide2022'] = "microsite_ide/ide2022";
$route['IDE2022'] = "microsite_ide/ide2022";

#SAFE2020
$route['SAFE2020'] = "microsite_safe";
$route['safe2020'] = "microsite_safe";

## FUTURE ENERGY 2021
$route['future-energy'] = "microsite_future_energy";

//SENTIMEN JSON
$route['sentimen'] = "sentimen";

#RSS 
$route['rss'] = "rss/index";
$route['rss/migas'] = "rss/migas";
$route['rss/headline'] = "rss/headline";
$route['rss/podcast'] = "rss/podcast";
$route['rss/podcast/(:any)'] = "rss/podcast/$1";
$route['rss/(:any)'] = "rss/index/$1";
$route['rss/(:any)/(:any)'] = "rss/subkanal/$1/$2";
$route['rss/emiten/(:any)'] = "rss/emiten/$1";
$route['rss/mailchimp'] = "rss/mailchimp";

#AWS Cognito
$route['aws'] = "aws";
$route['aws/register'] = "aws/register";

#SOROT
$route['sorot'] = "sorot/listing";
$route['sorot/getNextDetail'] = "sorot/getNextDetail";
$route['sorot/(:any)'] = "sorot/listing/$1";
$route['sorot/detail/(:any)/(:any)'] = "sorot/detail/$1/$2";

#BUKU#
$route['buku'] = "notfoundpage";

## KANAL - SUBKANAL ##
$route['laporan-khusus'] = "laporan_khusus";
$route['info-daerah'] = "info_daerah";
$route['info-lembaga'] = "infomark";
$route['info-perusahaan'] = "info_perusahaan";
$route['berita/getAllDataNext'] = "subkanal/getAllDataNext";
$route['energi/getAllDataNext'] = "subkanal/getAllDataNext";
$route['digital/getAllDataNext'] = "subkanal/getAllDataNext";
$route['finansial/getAllDataNext'] = "subkanal/getAllDataNext";
$route['video/getAllDataNext'] = "subkanal/getAllDataNext";
$route['indepth/getAllDataNext'] = "subkanal/getAllDataNext";
$route['ekonomi-hijau/getAllDataNext'] = "subkanal/getAllDataNext";
$route['brand/getAllDataNext'] = "subkanal/getAllDataNext";
$route['ekonopedia/getAllDataNext'] = "subkanal/getAllDataNext";
$route['berita/(:any)'] = "subkanal/listing/$1";
$route['energi/(:any)'] = "subkanal/listing/$1";
$route['digital/(:any)'] = "subkanal/listing/$1";
$route['finansial/(:any)'] = "subkanal/listing/$1";
$route['video/(:any)'] = "subkanal/listing/$1";
$route['indepth/(:any)'] = "subkanal/listing/$1";
$route['ekonomi-hijau/(:any)'] = "subkanal/listing/$1";
$route['brand/(:any)'] = "subkanal/listing/$1";
$route['ekonopedia/(:any)'] = "subkanal/listing/$1";
$route['podcast/(:any)'] = "subkanal/listing/$1";
$route['berita'] = "kanal/index/berita";
$route['energi'] = "kanal/index/energi";
$route['digital'] = "kanal/index/digital";
$route['finansial'] = "kanal/index/finansial";
$route['jurnalisme-data'] = "jurnalisme_data/listing";
$route['infografik'] = "kanal/index/infografik";
$route['analisisdata'] = "kanal/index/analisis";
$route['video'] = "kanal/index/video";
$route['foto'] = "kanal/index/foto";
$route['indepth'] = "kanal/index/indepth";
$route['ekonomi-hijau'] = "kanal/index/ekonomi-hijau";
$route['brand'] = "kanal/index/brand";
$route['ekonopedia'] = "kanal/index/ekonopedia";
$route['podcast'] = "kanal/index/podcast";
$route['penulis/getAllDataNext/'] = "penulis/getAllDataNext/";
$route['indepth/cakrawala/(:any)'] = "penulis/guest/$1";
$route['data-corona'] = "sorot/detail/26/krisis-virus-corona"; 
$route['impacto'] = "subkanal/impacto";

## MICROSITES ##
$route['jagaumkmindonesia'] = "microsite_umkm";
$route['jagaumkmindonesia2021'] = "microsite_umkm/umkm2021";  
$route['umkmbangkitbersamapajak'] = "microsite_djp";
$route['bisnis-umkm'] = "microsite_umkm_redaksi";
$route['umkm'] = "datablog/umkm";
$route['pelindungan-data-pribadi'] = "datablog/kic_pdp";
$route['literasi-digital-2021'] = "datablog/kic_kominfo";
$route['startup-digital'] = "datablog/startup_digital";
$route['transisi-energi'] = "datablog/transisi_energi";
$route['pemulihan-ekonomi'] = "datablog/pemulihan_ekonomi";
$route['merek-lokal'] = "datablog/merek_lokal";
$route['SurveiFinansialCovid'] = "datablog/survei_finansial";
$route['surveifinansialcovid'] = "datablog/survei_finansial";
$route['StatusLiterasiDigital'] = "datablog/status_literasi_digital";
$route['statusliterasidigital'] = "datablog/status_literasi_digital";
$route['surveilayanandigital'] = "datablog/survei_layanan_digital";
$route['SurveiLayananDigital'] = "datablog/survei_layanan_digital";
$route['SurveiVaksin'] = "datablog/survei_vaksin";
$route['surveivaksin'] = "datablog/survei_vaksin";
$route['SurveiVaksinasi'] = "datablog/survei_vaksinasi";
$route['surveivaksinasi'] = "datablog/survei_vaksinasi";
$route['SurveiPencarianData'] = "datablog/survei_pencariandata";
$route['surveipencariandata'] = "datablog/survei_pencariandata";
$route['SurveiPenggunaDataboks'] = "datablog/survei_penggunadataboks";
$route['surveipenggunadataboks'] = "datablog/survei_penggunadataboks";
$route['SurveiPDP'] = "datablog/survei_pdp";
$route['surveipdp'] = "datablog/survei_pdp";
$route['investasipilihangenz'] = "datablog/survei_zigi";
$route['platform-investasi'] = "datablog/platform_investasi"; 


$route['Survei-PDPindustri'] = "datablog/survei_pdp_industri_enum";
$route['survei-pdpindustri'] = "datablog/survei_pdp_industri_enum";
$route['SurveiPDPindustri'] = "datablog/survei_pdp_industri";
$route['surveipdpindustri'] = "datablog/survei_pdp_industri";
$route['SurveiPerilakuKeuangan'] = "datablog/survei_keuangan_investasi";
$route['surveiperilakukeuangan'] = "datablog/survei_keuangan_investasi";
$route['SurveiPerilakuInvestasi'] = "datablog/survei_investor_muda";
$route['surveiperilakuinvestasi'] = "datablog/survei_investor_muda";
$route['SurveiMediaReadership'] = "datablog/survei_perilaku_media";
$route['surveimediareadership'] = "datablog/survei_perilaku_media";
$route['SurveiProdukBerkelanjutan'] = "datablog/survei_produk_berkelanjutan";
$route['SurveiKualitasUdara'] = "datablog/survei_udarabersih";
$route['perilaku-ecommerce'] = "datablog/perilaku_ecommerce";
$route['kemnaker'] = "datablog/kemnaker";

$route['surveistartupdigital'] = "microsite_umkm_sisiplus";
$route['esport'] = "microsite_esport";
$route['masyarakat-adat'] = "microsite_ruu";
$route['ramadhan'] = "ramadhan";
$route['zakat'] = "ramadhan/zakat";
$route['semarak-ramadan'] = "ramadhan";
$route['ramadhan2020'] = "ramadhan2020";
$route['semarak-ramadan-2020'] = "ramadhan2020";
$route['safeforum2020'] = "microsite_safe";
$route['safeforum2021'] = "microsite_safe/safeforum2021";
$route['untukumkmindonesia'] = "microsite_linkaja";
$route['jagaumkmindonesia2'] = "microsite_unilever";
$route['melawan-corona'] = "microsite_corona";
$route['biodiesel-berkelanjutan'] = "microsite_clua_biodiesel";
$route['biodiesel-berkelanjutan/(:any)'] = "microsite_clua_biodiesel/microsite/$1";
// $route['biodiesel-berkelanjutan/(:any)/home'] = "microsite_clua_biodiesel/kanal/$1";
$route['biodiesel-uco'] = "microsite_clua_biodiesel/kanal";
$route['biodiesel-emisi'] = "microsite_clua_biodiesel/kanal";
$route['akselerasi-mobil-listrik'] = "microsite_clua_biodiesel/kanal";
$route['biodiesel-petani'] = "microsite_clua_biodiesel/kanal";
$route['biodiesel-petani-2021'] = "microsite_clua_biodiesel/kanal";
$route['thepowerofdata'] = "microsite_powerofdata";
$route['daerah-berkelanjutan'] = "microsite_daerah_berkelanjutan";
$route['kota-toleran-apeksi'] = "microsite_taf";
$route['covid-karhutla'] = "microsite_karhutla_2";
$route['perhutsos'] = "microsite_perhutsos";
$route['perhutsos/dashboard'] = "microsite_perhutsos/dashboard";
$route['perhutsos/listing/(:any)/(:any)'] = "microsite_perhutsos/listing/$1/$2";
$route['banggabuatanindonesia'] = "microsite_bbi";
$route['banggabuatanindonesia2'] = "microsite_bbi/bbi_2021";
$route['regionalsummit2020'] = "microsite_regional_summit";
$route['regionalsummit2021'] = "microsite_regional_summit/regional_2021";
$route['garniergreenbeauty'] = "microsite_garnier";
$route['babakbaruekonomi'] = "microsite_greenpeace";
$route['jfss2020'] = "microsite_jfss";
$route['JFSS2020'] = "microsite_jfss";
$route['limbahmedis'] = "microsite_kemenkes";
$route['STBMaward'] = "microsite_stbm";
$route['stbmaward'] = "microsite_stbm";
$route['sustainabilityday2020'] = "microsite_unilever_2";
$route['jfss-2020'] = "microsite_jfss_2";
$route['JFSS-2020'] = "microsite_jfss_2";
$route['sampah-jakarta'] = "longform_opener/sampah_jakarta";
$route['polusi-udara'] = "longform_opener/polusi_udara";
$route['riset-inovasi'] = "microsite_ksi";
$route['hutan-pilkada'] = "longform_opener/pilkada_madani";
$route['IPO-unicorn'] = "longform_opener/ipo_unicorn";
$route['event'] = "microsite_event_katadata";
$route['event/past_events'] = "microsite_event_katadata/past_events";
$route['event/articles'] = "microsite_event_katadata/articles";
$route['event/tes'] = "microsite_event_katadata/listEvent";
$route['masyarakat-adat'] = "microsite_ruu";
$route['outlook-2021'] = "microsite_outlook/outlook_2021";
$route['kereta-cepat'] = "microsite_kereta_cepat";
$route['kaleidoskop2020'] = "kaleidoskop/tahun2020";
$route['dci2021'] = "microsite_ev";
$route['investasi-milenial'] = "longform_opener/investasi_milenial";
$route['pandemi-dalam-angka'] = "microsite_pandemi_dalam_angka";
$route['pembiayaan-transisi-energi'] = "microsite_transisi_energi";

$route['ekonomi-sawit'] = "microsite_sawit"; 
$route['peran-tokopedia-selama-pandemi'] = "datablog/adopsidigitalumkm";
$route['bantuan-umkm'] = "datablog/bantuanumkm";
$route['SurveiPemilihanJurusanStudi'] = "datablog/surveijurusan";
$route['SurveiBelanjaOnline'] = "datablog/surveibelanjaonline";
$route['earthday2021'] = "microsite_hari_bumi";
$route['transportasi-bersih'] = "longform_opener/transportasi_bersih";
$route['investasi-berdampak'] = "datablog/investasiberdampak";
$route['pengelolaan-lingkungan'] = "longform_opener/pengelolaan_lingkungan"; 
$route['industri-migas-bangkit-pasca-pandemi'] = "longform_opener/industri_migas"; 

#INDEKSKELOLA
$route['indekskelola2020'] = "microsite_indekskelola";
$route['indekskelola2020/hasil'] = "microsite_indekskelola/hasil";
$route['indekskelola2020/hasil_keseluruhan'] = "microsite_indekskelola/hasil_keseluruhan";

#SETAHUN PANDEMI
$route['setahun-pandemi'] = "microsite_setahun_pandemi";
$route['persepsi-vaksinasi'] = "miniweb/persepsi_vaksinasi";
$route['profil-digital-daerah'] = "miniweb/profil_daerah";
$route['dua-tahun-pandemi'] = "miniweb/dua_tahun_pandemi";
$route['duatahunpandemi'] = "miniweb/dua_tahun_pandemi";

#ZIGI
$route['zigi'] = "microsite_zigi";
$route['zigi/about'] = "microsite_zigi/about";
$route['zigi/contact'] = "microsite_zigi/contact";

#Jelajah jalan raya pos
$route['jelajahjalanrayapos'] = "microsite_jalan_raya_pos";
$route['jelajahjalanrayapos/about'] = "microsite_jalan_raya_pos/about";
$route['jelajahjalanrayapos/explor'] = "microsite_jalan_raya_pos/explor";
$route['jelajahjalanrayapos/sponsor'] = "microsite_jalan_raya_pos/sponsor";
$route['jelajahjalanrayapos/explor/(:any)'] = "microsite_jalan_raya_pos/detail/$1";

#SHELL
$route['ShellLiveWIRE2021'] = "microsite_shell";
$route['shelllivewire2021'] = "microsite_shell";

#litdik
$route['literasidigital'] = "microsite_litdik";
$route['literasidigital/sesi-webinar'] = "microsite_litdik/getMoreData";
$route['literasidigital/newsletter_subscribe'] = "microsite_litdik/newsletter_subscribe";

#shipper
$route['game-changer'] = "microsite_shipperid";

#KompetisiSAPAUntukIndonesia
$route['KompetisiSAPAUntukIndonesia'] = "microsite_event_sampoerna";

#webinar SAPAUntukIndonesia
$route['SAPAUntukIndonesia'] = "microsite_sapa_untuk_indonesia";
$route['SAPAUntukIndonesia/newsletter_subscribe'] = "microsite_sapa_untuk_indonesia/newsletter_subscribe";

#fsm6
$route['fsm6'] = "microsite_fsm6";
$route['fsm6/sesi-webinar'] = "microsite_fsm6/getMoreData";
$route['fsm6/newsletter_subscribe'] = "microsite_fsm6/newsletter_subscribe";

#SETWAPRES
$route['setwapres'] = "microsite_setwapres";

#DASHBOARD INDEKS LITERASI DIGITAL
$route['dashboard-indeks-literasi-digital'] = "microsite_dashboard_ild";
$route['dashboard-literasi-digital'] = "microsite_dashboard_ild/dashboard";

# LANDING PAGE ROUTES
$route['pemenang-survei-perilaku-investasi'] = "landingpage/pemenang_survei_perencanaan_keuangan";
$route['pemenang-survei-literasi-digital'] = "landingpage_ps_literasi_digital/pemenang_survei_literasi_digital";

$route['katadata9'] = "hut_katadata/index_katadata9";
$route['katadata10'] = "hut_katadata/index_katadata10";

$route['katadata-perempuan'] = "microsite_katadata_perempuan";

$route['roadtocop26'] = "microsite_cop";

#G20
$route['G20Indonesia'] = "microsite_g20";
$route['G20Indonesia/eng'] = "microsite_g20/getpdate_eng";
$route['g20Indonesia'] = "microsite_g20";
$route['g20Indonesia/eng'] = "microsite_g20/getpdate_eng";

$route['G20Indonesia/T20'] = "microsite_g20/t20";
$route['g20Indonesia/t20'] = "microsite_g20/t20";

#Women leaders forum 2022
$route['WomenLeadersForum2022'] = "microsite_women_leader_forum"; 

## DCI2022
$route['DCI2022'] = "microsite_ev/dci2022";
$route['dci2022'] = "microsite_ev/dci2022";

## MICROSITE Jelajah UKM Go Global
$route['jelajah-ukm-go-global'] = "microsite_ukm_global";


$route['(:any)'] = "penulis/index/$1";

