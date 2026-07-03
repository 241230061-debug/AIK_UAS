<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SholatHptSeeder extends Seeder
{
    public function run(): void
    {
        // 0. Membuat Kategori Default terlebih dahulu agar tidak error Foreign Key
        // SUNTING BAGIAN INI DI SEEDER ANDA
        $kategoriId = DB::table('kategori')->insertGetId([
            'nama' => 'Sholat Fardhu', // Diubah dari 'nama_kategori' menjadi 'nama'
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 1. Gerakan: Niat & Takbiratul Ihram
        $g1 = DB::table('gerakan')->insertGetId([
            'id_kategori' => $kategoriId,
            'nama' => 'Niat dan Takbiratul Ihram',
            'urutan' => 1,
            'deskripsi' => 'Menghadap ke kiblat dan mengangkat kedua belah tangan dengan membaca Allahu Akbar.',
            'gambar_url' => null,
            'video_url' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('bacaan')->insert([
            'id_gerakan' => $g1,
            'urutan' => 1,
            'teks_arab' => 'اللَّهُمَّ بَاعِدْ بَيْنِي وَبَيْنَ خَطَايَايَ ، كَمَا بَاعَدْتَ بَيْنَ المَشْرِقِ وَالمَغْرِبِ ، اللَّهُمَّ نَقِّنِي مِنَ الخَطَايَا ، كَمَا يُنَقَّى الثَّوْبُ الأَبْيَضُ مِنَ الدَّنَسِ ، اللَّهُمَّ اغْسِلْ خَطَايَايَ بِالْمَاءِ ، وَالثَّلْجِ ، وَالبَرَدِ',
            'teks_latin' => 'Allahumma baaid baynii wa bayna khotoyaaya kamaa baa’adta baynal masyriqi wal maghrib. Allahumma naqqinii min khotoyaaya kamaa yunaqqots tsaubul abyadhu minad danas. Allahummagh-silnii min khotoyaaya bil maa-iwats tsalji wal barod.',
            'terjemahan' => 'Wahai Allah jauhkanlah antara aku dan kesalahan-kesalahanku sebagaimana engkau jauhkan antara timur dan barat, ya Allah bersihkanlah aku dari kesalahan sebagaimana bersihnya baju putih dari kotoran, ya Allah basuhlah kesalahan-kesalahanku dengan air, salju dan air dingin.',
            'audio_url' => null,
            'sumber' => 'HPT Muhammadiyah (HR. Bukhari & Muslim)',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2. Gerakan: Membaca Al-Fatihah
        $g2 = DB::table('gerakan')->insertGetId([
            'id_kategori' => $kategoriId,
            'nama' => 'Membaca Surat Al-Fatihah',
            'urutan' => 2,
            'deskripsi' => 'Membaca Surat Al Fatihah merupakan suatu hal yang wajib dilakukan ketika shalat setiap rakaatnya.',
            'gambar_url' => null,
            'video_url' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('bacaan')->insert([
            'id_gerakan' => $g2,
            'urutan' => 1,
            'teks_arab' => 'بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ (١) الْحَمْدُ لِلَّهِ رَبِّ الْعَالَمِينَ (٢) الرَّحْمَٰنِ الرَّحِيمِ (٣) مَالِكِ يَوْمِ الدِّينِ (٤) إِيَّاكَ نَعْبُدُ وَإِيَّاكَ نَسْتَعِينُ (٥) اهْدِنَا الصِّرَاطَ الْمُسْتَقِيمَ (٦) صِرَاطَ الَّذِينَ أَنْعَمْتَ عَلَيْهِهِمْ غَيْرِ الْمَغْضُوبِ عَلَيْهِمْ وَلَا الضَّالِّينَ (٧)',
            'teks_latin' => 'Bismillahir rahmaanir rahiim. Alhamdu lillahi rabbil ‘aalamiin. Ar-rahmaanir rahiim. Maaliki yawmiddiin. Iyyaaka na’budu wa iyyaaka nasta’iin. Ihdinaas shiraatal mustaqiim. Shiraatal ladziina an’amta ‘alaihim ghairil maghduubi ‘alaihim walad ddaalliin.',
            'terjemahan' => 'Dengan nama Allah Yang Maha Pengasih lagi Maha Penyayang. Segala puji bagi Allah, Tuhan seluruh alam. Yang Maha Pengasih lagi Maha Penyayang. Pemilik hari pembalasan. Hanya kepada Engkaulah kami menyembah dan hanya kepada Engkaulah kami mohon pertolongan. Tunjukilah kami jalan yang lurus. (yaitu) jalan orang-orang yang telah Engkau beri nikmat kepadanya; bukan (jalan) mereka yang dimurkai, dan bukan (pula jalan) mereka yang sesat.',
            'audio_url' => null,
            'sumber' => 'HPT Muhammadiyah (HR. Bukhari & Muslim)',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 3. Gerakan: Ruku'
        $g3 = DB::table('gerakan')->insertGetId([
            'id_kategori' => $kategoriId,
            'nama' => 'Ruku’ dan Tuma’ninah',
            'urutan' => 3,
            'deskripsi' => 'Ruku’ dilakukan dengan melapangkan punggung dengan leher dan kedua belah tangan memegang lutut sembari thuma’ninah.',
            'gambar_url' => null,
            'video_url' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('bacaan')->insert([
            'id_gerakan' => $g3,
            'urutan' => 1,
            'teks_arab' => 'سُبْحَانَكَ اللّهم رَبَّنَا وَبِحَمْدِكَ اللّهم اغْفِرْلِيْ',
            'teks_latin' => 'Subhaanakallaahumma rabbanaa wabihamdika Allaahummagh firlii',
            'terjemahan' => 'Maha Suci Engkau, ya Allah. Dan dengan memuji Engkau, ya Allah, aku memohon ampun.',
            'audio_url' => null,
            'sumber' => 'HPT Muhammadiyah (HR. Bukhari No. 793 & Muslim No. 397)',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 4. Gerakan: I'tidal
        $g4 = DB::table('gerakan')->insertGetId([
            'id_kategori' => $kategoriId,
            'nama' => 'I’tidal setelah rukuk dan Thuma’ninah',
            'urutan' => 4,
            'deskripsi' => 'Dilakukan dengan mengangkat kedua belah tangan seperti dalam takbiratul ihram.',
            'gambar_url' => null,
            'video_url' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('bacaan')->insert([
            [
                'id_gerakan' => $g4,
                'urutan' => 1,
                'teks_arab' => 'سَمِعَ اللهُ لِمَنْ حَمِدَهُ . رَبَّنَا وَلَكَ الْحَمْدُ',
                'teks_latin' => 'Sami’allaahu liman hamidah. Rabbanaa wa lakal hamd',
                'terjemahan' => 'Allah mendengar orang yang memuji Nya. Ya Tuhanku, segala puji itu bagi engkau',
                'audio_url' => null,
                'sumber' => 'HPT Muhammadiyah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_gerakan' => $g4,
                'urutan' => 2,
                'teks_arab' => 'سَمِعَ اللهُ لِمَنْ حَمِدَهُ رَبَّنَا وَلَكَ الْحَمْدُ مِلْءُ السَّموتِ وَمِلْ ءُالْأَرْضِ وَمِلْءُ مَا شِئْتَ مِنْ شَيْءٍ بَعْدُ',
                'teks_latin' => 'Sami’allahu limah hamidah. Allahumma robbana lakal hamdu mil us samaa waa ti wa mil ul ardhi wa mil umaa syi’ta syai in ba’du',
                'terjemahan' => 'Ya Allah, Tuhanku, bagiMu segala puji, sepenuh semua langit, sepenuh bumi, dan sepenuh semua apa yang Kau sukai dari sesuatu apapun',
                'audio_url' => null,
                'sumber' => 'HPT Muhammadiyah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_gerakan' => $g4,
                'urutan' => 3,
                'teks_arab' => 'سَمِعَ اللهُ لِمَنْ حَمِدَهُ رَبَّناَ وَلَكَ الْحَمْدُ حَمْدًا كَثِيْرًا طَيِّبًا مُبَارَكًافِيْهِ',
                'teks_latin' => 'Sami’allaahu liman hamidah. Rabbanaa wa lakal hamdu hamdan katsiran thayyiban mubaarokan fiih',
                'terjemahan' => 'Allah mendengar orang yang memujinya. Ya Tuhanku, bagi Mulah segala puji, pujian yang banyak, baik dan memberkati',
                'audio_url' => null,
                'sumber' => 'HPT Muhammadiyah',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // 5. Gerakan: Sujud
        $g5 = DB::table('gerakan')->insertGetId([
            'id_kategori' => $kategoriId,
            'nama' => 'Sujud dua kali dalam satu rakaat',
            'urutan' => 5,
            'deskripsi' => 'Dilakukan dengan takbir, letakkan kedua lutut dan jari kaki di atas tanah, lalu kedua tangan, kemudian dahi dan hidung. Hadapkan ujung kaki ke kiblat dan regangkan tangan dari lambung.',
            'gambar_url' => null,
            'video_url' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('bacaan')->insert([
            [
                'id_gerakan' => $g5,
                'urutan' => 1,
                'teks_arab' => 'سُبْحَانَكَ اللهُمَّ رَبَّنَا وَبِحَمْدِكَ اللهُمَّ اغْفِرْلِيْ',
                'teks_latin' => 'Subhaanakallah humma rabbanaa wa bihamdikallahummaghfirlii',
                'terjemahan' => 'Maha suci Engkau, Ya Allah, dan dengan memuji kepada Engkau, Ya Allah, aku memohon ampun',
                'audio_url' => null,
                'sumber' => 'HPT Muhammadiyah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_gerakan' => $g5,
                'urutan' => 2,
                'teks_arab' => 'سُبْحَانَ رَبِّيَ الْأَعْلَى',
                'teks_latin' => 'Subhaana Rabbiyal a’laa',
                'terjemahan' => 'Maha suci Tuhanku yang Maha Tinggi',
                'audio_url' => null,
                'sumber' => 'HPT Muhammadiyah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_gerakan' => $g5,
                'urutan' => 3,
                'teks_arab' => 'سُبُّوْحٌ قُدُّوْسٌ رَبٌّ الْمَلَا ئِكَةِ وَالرُّوْحِ',
                'teks_latin' => 'Subbuuhun quddusun rabbul malaaikati warruuh',
                'terjemahan' => 'Maha Suci, Maha Kudus, Tuhannya sekalian Malaikat dan Ruh (Jibril).',
                'audio_url' => null,
                'sumber' => 'HPT Muhammadiyah',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // 6. Gerakan: Duduk di Antara Dua Sujud
        $g6 = DB::table('gerakan')->insertGetId([
            'id_kategori' => $kategoriId,
            'nama' => 'Duduk di antara dua sujud',
            'urutan' => 6,
            'deskripsi' => 'Dilakukan dengan mengangkat kepala seraya bertakbir dan duduk tenang.',
            'gambar_url' => null,
            'video_url' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('bacaan')->insert([
            'id_gerakan' => $g6,
            'urutan' => 1,
            'teks_arab' => 'اَللّهُمَ اغْفِرْلِيْ وارْحَمنِيْ وَاجْبُرْنِيْ وَاهْدِنِيْ وَارْزُقْنِيْ',
            'teks_latin' => 'Allaahummaghfirlii warhamnii wajburnii wahdinii warzuqnii',
            'terjemahan' => 'Ya Allah, ampunilah aku, belas kasihanilah aku, cukupilah aku, tunjukilah aku dan berikanlah rezeki kepadaku',
            'audio_url' => null,
            'sumber' => 'HPT Muhammadiyah',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 7. Gerakan: Tasyahud Akhir
        $g7 = DB::table('gerakan')->insertGetId([
            'id_kategori' => $kategoriId,
            'nama' => 'Tasyahud Akhir',
            'urutan' => 7,
            'deskripsi' => 'Duduk tasyahud akhir dengan membaca tasyahud, sholawat, dan doa perlindungan.',
            'gambar_url' => null,
            'video_url' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('bacaan')->insert([
            [
                'id_gerakan' => $g7,
                'urutan' => 1,
                'teks_arab' => 'اَلتَّحِيَّاتُ لِلّهِ وَالصَّلَوَاتُ وَالطَّيِّباَتُ. اَلسَّلاَمُ عَلَيْكَ أَيُwّهاَ النَّبِيُّوَرَحْمَةُ اللهِ وَبَرَكاَتُهُ. اَلسَّلاَمُ عَلَيْناَ وَعَلَى عِbaَدِاللهِ الصَّالِحِيْنَ أَشْهَدُ اَنْ لاَاِلَهَ اِلاَّ اللهِ وَأَشْهَدُ أَنَّ مُحَمَّدًا عَبْدُهُ وَرَسُوْلُهُ',
                'teks_latin' => 'Attahiyyaatu lillaahi washsholawaatu waththoyyibaat. Assalaamu ‘alaika ayyuhannabiyyu warohmatullaahi wabarokaatuh. Assalaamu’alainaa wa’ala ‘ibaadillaahi shshoolihiin. Asyhadu anlaa ilaaha illallaah waasyhadu annamuhammadan ‘abduhu warosuuluh',
                'terjemahan' => 'Segala kehormatan, kebahagiaan dan kebagusan adalah kepunyaan Allah, Semoga keselamatan bagi Engkau, ya Nabi Muhammad, beserta rahmat dan kebahagiaan Allah. Mudah-mudahan keselamatan juga bagi kita sekalian dan hamba-hamba Allah yang baik-baik. Aku bersaksi bahwa tiada Tuhan melainkan Allah dan aku bersaksi bahwa Muhammad itu hamba Allah dan utusan-Nya,',
                'audio_url' => null,
                'sumber' => 'HPT Muhammadiyah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_gerakan' => $g7,
                'urutan' => 2,
                'teks_arab' => 'اللَّهُمَّ صَلِّ عَلَى مُحَمَّدٍ ، وَعَلَى آلِ مُحَمَّدٍ , كَمَا صَلَّيْتَ عَلَى إِبْرَاهِيمَ وَعَلَى آلِ إِبْرَاهِيمَ ، إِنَّكَ حَمِيدٌ مَجِيدٌ ، اللَّهُمَّ بَارِكْ عَلَى مُحَمَّدٍ ، وَعَلَى آلِ مُحَمَّدٍ ، كَمَا بَارَكْتَ عَلَى إِبْرَاهِيمَ ، وَعَلَى آلِ إِبْرَاهِيمَ ، إِنَّكَ حَمِيدٌ مَجِيدٌ',
                'teks_latin' => 'Allahumma sholli ‘ala Muhammad wa ‘ala aali Muhammad kamaa shollaita ‘ala Ibroohim wa ‘ala aali Ibrohim, innaka hamidun majiid. Allahumma baarik ‘ala Muhammad wa ‘ala aali Muhammad kamaa baarokta ‘ala Ibrohim wa ‘ala aali Ibrohimm innaka hamidun majiid',
                'terjemahan' => 'Ya Allah, semoga shalawat tercurah kepada Muhammad dan keluarga Muhammad. Seperti rahmat yang tercurah pada Ibrahim dan keluarga Ibrahim. Dan limpahilah berkah atas Nabi Muhammad beserta para keluarganya. Seperti berkah yang Engkau berikan kepada Nabi Ibrahim dan keluarganya. Sesungguhnya Engkau Maha Terpuji lagi Maha Mulia di seluruh alam,',
                'audio_url' => null,
                'sumber' => 'HPT Muhammadiyah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_gerakan' => $g7,
                'urutan' => 3,
                'teks_arab' => 'اَللَّهُمَّ إِنِّيْ أَعُوْذُ بِكَ مِنْ عَذَابِ جَهَنَّمَ وَمِنْ عَذَابِ الْقَبْرِ وَمِنْ فِتْنَةِ الْمَحْيَا وَالْمَمَاتِ وَمِنْ شَرِّفِتْنَةِ الْمَسِيْحِ الدَّجَّالِ',
                'teks_latin' => 'Allaahumma inni a’uudzubika min ‘adzaabil qabri wa min ‘adzaabinnaari jahannama wa min fitnatil mahyaa wal mamaati wa min fitnatil masiihid dajjaal.',
                'terjemahan' => 'Ya Allah, sesungguhnya aku berlindung kepadaMu dari adzab Jahannam, dari adzab kubur, dari fitnah kehidupan dan kematian, dan dari keburukan fitnah Dajjal.',
                'audio_url' => null,
                'sumber' => 'HPT Muhammadiyah',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // 8. Gerakan: Salam
        $g8 = DB::table('gerakan')->insertGetId([
            'id_kategori' => $kategoriId,
            'nama' => 'Salam',
            'urutan' => 8,
            'deskripsi' => 'Penghabisan shalat dengan menoleh ke kanan lalu ke kiri.',
            'gambar_url' => null,
            'video_url' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('bacaan')->insert([
            [
                'id_gerakan' => $g8,
                'urutan' => 1,
                'teks_arab' => 'Ke kanan & kiri: السَّلاَمُ عَلَيْكُمْ وَرَحْمَةُ اللهِ وَبَرَكَاتُهُ',
                'teks_latin' => 'Assalaamu ‘alaikum warahmatullaahi wabarokaatuh',
                'terjemahan' => 'Semoga keselamatan, rahmat Allah, dan berkah-Nya tercurah kepada kalian.',
                'audio_url' => null,
                'sumber' => 'HPT Muhammadiyah (HR. Ali bin Abi Thalib)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_gerakan' => $g8,
                'urutan' => 2,
                'teks_arab' => 'Ke kanan & kiri: السَّلاَمُ عَلَيْكُمْ وَرَحْمَةُ اللهِ',
                'teks_latin' => 'Assalaamu ‘alaikum warahmatullaah',
                'terjemahan' => 'Semoga keselamatan dan rahmat Allah tercurah kepada kalian.',
                'audio_url' => null,
                'sumber' => 'HPT Muhammadiyah (HR. Ali bin Abi Thalib)',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}