<?php

namespace Database\Seeders;

use App\Models\Gerakan;
use App\Models\Bacaan;
use Illuminate\Database\Seeder;

class SholatSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Niat & Takbiratul Ihram
        $g1 = Gerakan::create([
            'nama_gerakan' => 'Niat dan Takbiratul Ihram',
            'deskripsi' => 'Menghadap ke kiblat dan mengangkat kedua belah tangan dengan membaca Allahu Akbar.',
            'urutan' => 1
        ]);
        Bacaan::create([
            'gerakan_id' => $g1->id,
            'nama_bacaan' => 'Doa Iftitah',
            'arab' => 'اللَّهُمَّ بَاعِدْ بَيْنِي وَبَيْنَ خَطَايَايَ ، كَمَا بَاعَدْتَ بَيْنَ المَشْرِقِ وَالمَغْرِبِ ، اللَّهُمَّ نَقِّنِي مِنَ الخَطَايَا ، كَمَا يُنَقَّى الثَّوْبُ الأَبْيَضُ مِنَ الدَّنَسِ ، اللَّهُمَّ اغْسِلْ خَطَايَايَ بِالْمَاءِ ، وَالثَّلْجِ ، وَالبَرَدِ',
            'latin' => 'Allahumma baaid baynii wa bayna khotoyaaya kamaa baa’adta baynal masyriqi wal maghrib. Allahumma naqqinii min khotoyaaya kamaa yunaqqots tsaubul abyadhu minad danas. Allahummagh-silnii min khotoyaaya bil maa-iwats tsalji wal barod.',
            'arti' => 'Wahai Allah jauhkanlah antara aku dan kesalahan-kesalahanku sebagaimana engkau jauhkan antara timur dan barat, ya Allah bersihkanlah aku dari kesalahan sebagaimana bersihnya baju putih dari kotoran, ya Allah basuhlah kesalahan-kesalahanku dengan air, salju dan air dingin.'
        ]);

        // 2. Membaca Al-Fatihah
        $g2 = Gerakan::create([
            'nama_gerakan' => 'Membaca Surat Al-Fatihah',
            'deskripsi' => 'Membaca Surat Al Fatihah merupakan suatu hal yang wajib dilakukan ketika shalat setiap rakaatnya.',
            'urutan' => 2
        ]);
        Bacaan::create([
            'gerakan_id' => $g2->id,
            'nama_bacaan' => 'Surat Al-Fatihah',
            'arab' => 'بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ... (الْفَاتِحَة)',
            'latin' => 'Bismillahir rahmanir rahim...',
            'arti' => 'Dengan nama Allah Yang Maha Pengasih lagi Maha Penyayang...'
        ]);

        // 3. Ruku'
        $g3 = Gerakan::create([
            'nama_gerakan' => 'Ruku’ dan Tuma’ninah',
            'deskripsi' => 'Ruku’ dilakukan dengan melapangkan punggung dengan leher dan kedua belah tangan memegang lutut sembari thuma’ninah.',
            'urutan' => 3
        ]);
        Bacaan::create([
            'gerakan_id' => $g3->id,
            'nama_bacaan' => 'Doa Ruku',
            'arab' => 'سُبْحَانَكَ اللّهم رَبَّنَا وَبِحَمْدِكَ اللّهم اغْفِرْلِيْ',
            'latin' => 'Subhaanakallaahumma rabbanaa wabihamdika Allaahummagh firlii',
            'arti' => 'Maha Suci Engkau, ya Allah. Dan dengan memuji Engkau, ya Allah, aku memohon ampun.'
        ]);

        // 4. I'tidal
        $g4 = Gerakan::create([
            'nama_gerakan' => 'I’tidal setelah rukuk dan Thuma’ninah',
            'deskripsi' => 'Dilakukan dengan mengangkat kedua belah tangan seperti dalam takbiratul ihram.',
            'urutan' => 4
        ]);
        Bacaan::create([
            'gerakan_id' => $g4->id,
            'nama_bacaan' => 'Doa I\'tidal Pilihan 1',
            'arab' => 'سَمِعَ اللهُ لِمَنْ حَمِدَهُ . رَبَّنَا وَلَكَ الْحَمْدُ',
            'latin' => 'Sami’allaahu liman hamidah. Rabbanaa wa lakal hamd',
            'arti' => 'Allah mendengar orang yang memuji Nya. Ya Tuhanku, segala puji itu bagi engkau'
        ]);
        Bacaan::create([
            'gerakan_id' => $g4->id,
            'nama_bacaan' => 'Doa I\'tidal Pilihan 2',
            'arab' => 'سَمِعَ اللهُ لِمَنْ حَمِدَهُ رَبَّنَا وَلَكَ الْحَمْدُ مِلْءُ السَّموتِ وَمِلْ ءُالْأَرْضِ وَمِلْءُ مَا شِئْتَ مِنْ شَيْءٍ بَعْدُ',
            'latin' => 'Sami’allahu limah hamidah. Allahumma robbana lakal hamdu mil us samaa waa ti wa mil ul ardhi wa mil umaa syi’ta syai in ba’du',
            'arti' => 'Ya Allah, Tuhanku, bagiMu segala puji, sepenuh semua langit, sepenuh bumi, dan sepenuh semua apa yang Kau sukai dari sesuatu apapun'
        ]);
        Bacaan::create([
            'gerakan_id' => $g4->id,
            'nama_bacaan' => 'Doa I\'tidal Pilihan 3',
            'arab' => 'سَمِعَ اللهُ لِمَنْ حَمِدَهُ رَبَّناَ وَلَكَ الْحَمْدُ حَمْدًا كَثِيْرًا طَيِّبًا مُبَارَكًافِيْهِ',
            'latin' => 'Sami’allaahu liman hamidah. Rabbanaa wa lakal hamdu hamdan katsiran thayyiban mubaarokan fiih',
            'arti' => 'Allah mendengar orang yang memujinya. Ya Tuhanku, bagi Mulah segala puji, pujian yang banyak, baik dan memberkati'
        ]);

        // 5. Sujud
        $g5 = Gerakan::create([
            'nama_gerakan' => 'Sujud dua kali dalam satu rakaat',
            'deskripsi' => 'Dilakukan dengan takbir, letakkan kedua lutut dan jari kaki di atas tanah, lalu kedua tangan, kemudian dahi dan hidung. Hadapkan ujung kaki ke kiblat dan regangkan tangan dari lambung.',
            'urutan' => 5
        ]);
        Bacaan::create([
            'gerakan_id' => $g5->id,
            'nama_bacaan' => 'Doa Sujud Pilihan 1',
            'arab' => 'سُبْحَانَكَ اللهُمَّ رَبَّنَا وَبِحَمْدِكَ اللهُمَّ اغْفِرْلِيْ',
            'latin' => 'Subhaanakallah humma rabbanaa wa bihamdikallahummaghfirlii',
            'arti' => 'Maha suci Engkau, Ya Allah, dan dengan memuji kepada Engkau, Ya Allah, aku memohon ampun'
        ]);
        Bacaan::create([
            'gerakan_id' => $g5->id,
            'nama_bacaan' => 'Doa Sujud Pilihan 2',
            'arab' => 'سُبْحَانَ رَبِّيَ الْأَعْلَى',
            'latin' => 'Subhaana Rabbiyal a’laa',
            'arti' => 'Maha suci Tuhanku yang Maha Tinggi'
        ]);
        Bacaan::create([
            'gerakan_id' => $g5->id,
            'nama_bacaan' => 'Doa Sujud Pilihan 3',
            'arab' => 'سُبُّوْحٌ قُدُّوْسٌ رَبٌّ الْمَلَا ئِكَةِ وَالرُّوْحِ',
            'latin' => 'Subbuuhun quddusun rabbul malaaikati warruuh',
            'arti' => 'Maha Suci, Maha Kudus, Tuhannya sekalian Malaikat dan Ruh (Jibril).'
        ]);

        // 6. Duduk di antara dua sujud
        $g6 = Gerakan::create([
            'nama_gerakan' => 'Duduk di antara dua sujud',
            'deskripsi' => 'Dilakukan dengan mengangkat kepala seraya bertakbir dan duduk tenang.',
            'urutan' => 6
        ]);
        Bacaan::create([
            'gerakan_id' => $g6->id,
            'nama_bacaan' => 'Doa Duduk di Antara Dua Sujud',
            'arab' => 'اَللّهُمَ اغْفِرْلِيْ وارْحَمنِيْ وَاجْبُرْنِيْ وَاهْدِنِيْ وَارْزُقْنِيْ',
            'latin' => 'Allaahummaghfirlii warhamnii wajburnii wahdinii warzuqnii',
            'arti' => 'Ya Allah, ampunilah aku, belas kasihanilah aku, cukupilah aku, tunjukilah aku dan berikanlah rezeki kepadaku'
        ]);

        // 7. Tasyahud Akhir
        $g7 = Gerakan::create([
            'nama_gerakan' => 'Tasyahud Akhir',
            'deskripsi' => 'Duduk tasyahud akhir dengan membaca tasyahud, sholawat, dan doa perlindungan.',
            'urutan' => 7
        ]);
        Bacaan::create([
            'gerakan_id' => $g7->id,
            'nama_bacaan' => 'Bacaan Tasyahud',
            'arab' => 'اَلالتَّحِيَّاتُ لِلّهِ وَالصَّلَوَاتُ وَالطَّيِّباَتُ. اَلسَّلاَمُ عَلَيْكَ أَيُّهاَ النَّبِيُّوَرَحْمَةُ اللهِ وَبَرَكاَتُهُ. اَلسَّلاَمُ عَلَيْناَ وَعَلَى عِbaَدِاللهِ الصَّالِحِيْنَ أَشْهَدُ اَنْ لاَاِلَهَ اِلاَّ اللهِ وَأَشْهَدُ أَنَّ مُحَمَّدًا عَبْدُهُ وَرَسُوْلُهُ',
            'latin' => 'Attahiyyaatu lillaahi washsholawaatu waththoyyibaat. Assalaamu ‘alaika ayyuhannabiyyu warohmatullaahi wabarokaatuh. Assalaamu’alainaa wa’ala ‘ibaadillaahi shshoolihiin. Asyhadu anlaa ilaaha illallaah waasyhadu annamuhammadan ‘abduhu warosuuluh',
            'arti' => 'Segala kehormatan, kebahagiaan dan kebagusan adalah kepunyaan Allah, Semoga keselamatan bagi Engkau, ya Nabi Muhammad, beserta rahmat dan kebahagiaan Allah. Mudah-mudahan keselamatan juga bagi kita sekalian dan hamba-hamba Allah yang baik-baik. Aku bersaksi bahwa tiada Tuhan melainkan Allah dan aku bersaksi bahwa Muhammad itu hamba Allah dan utusan-Nya,'
        ]);
        Bacaan::create([
            'gerakan_id' => $g7->id,
            'nama_bacaan' => 'Membaca Sholawat',
            'arab' => 'اللَّهُمَّ صَلِّ عَلَى مُحَمَّدٍ ، وَعَلَى آلِ مُحَمَّدٍ ، كَمَا صَلَّيْتَ عَلَى إِبْرَاهِيمَ وَعَلَى آلِ إِبْرَاهِيمَ ، إِنَّكَ حَمِيدٌ مَجِيدٌ , اللَّهُمَّ بَارِك...َ عَلَى مُحَمَّدٍ ، وَعَلَى آلِ مُحَمَّدٍ ، كَمَا بَارَكْتَ عَلَى إِبْرَاهِيمَ ، وَعَلَى آلِ إِبْرَاهِيمَ ، إِنَّكَ حَمِيدٌ مَجِيدٌ',
            'latin' => 'Allahumma sholli ‘ala Muhammad wa ‘ala aali Muhammad kamaa shollaita ‘ala Ibroohim wa ‘ala aali Ibrohim, innaka hamidun majiid. Allahumma baarik ‘ala Muhammad wa ‘ala aali Muhammad kamaa baarokta ‘ala Ibrohim wa ‘ala aali Ibrohimm innaka hamidun majiid',
            'arti' => 'Ya Allah, semoga shalawat tercurah kepada Muhammad dan keluarga Muhammad. Seperti rahmat yang tercurah pada Ibrahim dan keluarga Ibrahim. Dan limpahilah berkah atas Nabi Muhammad beserta para keluarganya. Seperti berkah yang Engkau berikan kepada Nabi Ibrahim dan keluarganya. Sesungguhnya Engkau Maha Terpuji lagi Maha Mulia di seluruh alam,'
        ]);
        Bacaan::create([
            'gerakan_id' => $g7->id,
            'nama_bacaan' => 'Doa Memohon Perlindungan',
            'arab' => 'اَللَّهُمَّ إِنِّيْ أَعُوْذُ بِكَ مِنْ عَذَابِ جَهَنَّمَ وَمِنْ عَذَابِ الْقَبْرِ وَمِنْ فِتْنَةِ الْمَحْيَا وَالْمَمَاتِ وَمِن *ْ شَرِّفِتْنَةِ الْمَسِيْحِ الدَّجَّالِ',
            'latin' => 'Allaahumma inni a’uudzubika min ‘adzaabil qabri wa min ‘adzaabinnaari jahannama wa min fitnatil mahyaa wal mamaati wa min fitnatil masiihid dajjaal.',
            'arti' => 'Ya Allah, sesungguhnya aku berlindung kepadaMu dari adzab Jahannam, dari adzab kubur, dari fitnah kehidupan dan kematian, dan dari keburukan fitnah Dajjal.'
        ]);

        // 8. Salam
        $g8 = Gerakan::create([
            'nama_gerakan' => 'Salam',
            'deskripsi' => 'Penghabisan shalat dengan menoleh ke kanan lalu ke kiri.',
            'urutan' => 8
        ]);
        Bacaan::create([
            'gerakan_id' => $g8->id,
            'nama_bacaan' => 'Salam Variasi Lengkap',
            'arab' => 'Ke kanan & kiri: السَّلاَمُ عَلَيْكُمْ وَرَحْمَةُ اللهِ وَبَرَكَاتُهُ',
            'latin' => 'Assalaamu ‘alaikum warahmatullaahi wabarokaatuh',
            'arti' => 'Semoga keselamatan, rahmat Allah, dan berkah-Nya tercurah kepada kalian.'
        ]);
        Bacaan::create([
            'gerakan_id' => $g8->id,
            'nama_bacaan' => 'Salam Variasi Pendek',
            'arab' => 'Ke kanan & kiri: السَّلاَمُ عَلَيْكُمْ وَرَحْمَةُ اللهِ',
            'latin' => 'Assalaamu ‘alaikum warahmatullaah',
            'arti' => 'Semoga keselamatan dan rahmat Allah tercurah kepada kalian.'
        ]);
    }
}