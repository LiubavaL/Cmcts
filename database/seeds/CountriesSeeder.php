<?php

use Illuminate\Database\Seeder;
use App\Models\Country;


class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->delete();

        $country = Country::create([
            'name' => 'Азербайджан',
        ]);

        $country = Country::create([
            'name' => 'Армения',
        ]);

        $country = Country::create([
            'name' => 'Афганистан',
        ]);

        $country = Country::create([
            'name' => 'Бангладеш',
        ]);

        $country = Country::create([
            'name' => 'Бахрейн',
        ]);

        $country = Country::create([
            'name' => 'Бруней',
        ]);

        $country = Country::create([
            'name' => 'Бутан',
        ]);

        $country = Country::create([
            'name' => 'Восточный Тимор',
        ]);

        $country = Country::create([
            'name' => 'Вьетнам',
        ]);

        $country = Country::create([
            'name' => 'Грузия',
        ]);

        $country = Country::create([
            'name' => 'Израиль',
        ]);

        $country = Country::create([
            'name' => 'Индия',
        ]);

        $country = Country::create([
            'name' => 'Индонезия',
        ]);

        $country = Country::create([
            'name' => 'Иордания',
        ]);

        $country = Country::create([
            'name' => 'Ирак',
        ]);

        $country = Country::create([
            'name' => 'Иран',
        ]);

        $country = Country::create([
            'name' => 'Йемен',
        ]);

        $country = Country::create([
            'name' => 'Казахстан',
        ]);

        $country = Country::create([
            'name' => 'Узбекистан',
        ]);

        $country = Country::create([
            'name' => 'Камбоджа',
        ]);

        $country = Country::create([
            'name' => 'Катар',
        ]);

        $country = Country::create([
            'name' => 'Кипр',
        ]);

        $country = Country::create([
            'name' => 'Киргизия',
        ]);

        $country = Country::create([
            'name' => 'КНДР',
        ]);

        $country = Country::create([
            'name' => 'Китай',
        ]);

        $country = Country::create([
            'name' => 'Кувейт',
        ]);

        $country = Country::create([
            'name' => 'Лаос',
        ]);

        $country = Country::create([
            'name' => 'Ливан',
        ]);

        $country = Country::create([
            'name' => 'Макао',
        ]);

        $country = Country::create([
            'name' => 'Малайзия',
        ]);

        $country = Country::create([
            'name' => 'Мальдивы',
        ]);

        $country = Country::create([
            'name' => 'Монголия',
        ]);

        $country = Country::create([
            'name' => 'Мьянма',
        ]);

        $country = Country::create([
            'name' => 'Непал',
        ]);

        $country = Country::create([
            'name' => 'ОАЭ',
        ]);

        $country = Country::create([
            'name' => 'Оман',
        ]);

        $country = Country::create([
            'name' => 'Пакистан',
        ]);

        $country = Country::create([
            'name' => 'Палестина',
        ]);

        $country = Country::create([
            'name' => 'Тайвань',
        ]);

        $country = Country::create([
            'name' => 'Саудовская Аравия',
        ]);

        $country = Country::create([
            'name' => 'Сингапур',
        ]);

        $country = Country::create([
            'name' => 'Сирия',
        ]);

        $country = Country::create([
            'name' => 'Таджикистан',
        ]);

        $country = Country::create([
            'name' => 'Таиланд',
        ]);

        $country = Country::create([
            'name' => 'Туркменистан',
        ]);

        $country = Country::create([
            'name' => 'Турция',
        ]);

        $country = Country::create([
            'name' => 'Филиппины',
        ]);

        $country = Country::create([
            'name' => 'Шри-Ланка',
        ]);

        $country = Country::create([
            'name' => 'Южная Корея',
        ]);

        $country = Country::create([
            'name' => 'Япония',
        ]);

        $country = Country::create([
            'name' => 'Алжир',
        ]);

        $country = Country::create([
            'name' => 'Ангола',
        ]);

        $country = Country::create([
            'name' => 'Бенин',
        ]);

        $country = Country::create([
            'name' => 'Ботсвана',
        ]);

        $country = Country::create([
            'name' => 'Буркина-Фасо',
        ]);

        $country = Country::create([
            'name' => 'Бурунди',
        ]);

        $country = Country::create([
            'name' => 'Габон',
        ]);

        $country = Country::create([
            'name' => 'Гамбия',
        ]);

        $country = Country::create([
            'name' => 'Гана',
        ]);

        $country = Country::create([
            'name' => 'Гвинея',
        ]);

        $country = Country::create([
            'name' => 'Гвинея-Бисау',
        ]);

        $country = Country::create([
            'name' => 'Джибути',
        ]);

        $country = Country::create([
            'name' => 'Египет',
        ]);

        $country = Country::create([
            'name' => 'Замбия',
        ]);

        $country = Country::create([
            'name' => 'Западная Сахара',
        ]);

        $country = Country::create([
            'name' => 'Зимбабве',
        ]);

        $country = Country::create([
            'name' => 'Кабо-Верде',
        ]);

        $country = Country::create([
            'name' => 'Кот-д\'Ивуар',
        ]);

        $country = Country::create([
            'name' => 'Камерун',
        ]);

        $country = Country::create([
            'name' => 'Кения',
        ]);

        $country = Country::create([
            'name' => 'Коморские острова',
        ]);

        $country = Country::create([
            'name' => 'Демократическая Республика Конго',
        ]);

        $country = Country::create([
            'name' => 'Лесото',
        ]);

        $country = Country::create([
            'name' => 'Либерия',
        ]);

        $country = Country::create([
            'name' => 'Ливия',
        ]);

        $country = Country::create([
            'name' => 'Маврикий',
        ]);

        $country = Country::create([
            'name' => 'Мавритания',
        ]);

        $country = Country::create([
            'name' => 'Мадагаскар',
        ]);

        $country = Country::create([
            'name' => 'Малави',
        ]);

        $country = Country::create([
            'name' => 'Мали',
        ]);

        $country = Country::create([
            'name' => 'Марокко',
        ]);

        $country = Country::create([
            'name' => 'Мозамбик',
        ]);

        $country = Country::create([
            'name' => 'Намибия',
        ]);

        $country = Country::create([
            'name' => 'Нигер',
        ]);

        $country = Country::create([
            'name' => 'Нигерия',
        ]);

        $country = Country::create([
            'name' => 'Реюньон',
        ]);

        $country = Country::create([
            'name' => 'Руанда',
        ]);

        $country = Country::create([
            'name' => 'Сан-Томе и Принсипи',
        ]);

        $country = Country::create([
            'name' => 'Свазиленд',
        ]);

        $country = Country::create([
            'name' => 'Святой Елены Остров',
        ]);

        $country = Country::create([
            'name' => 'Сейшельские острова',
        ]);

        $country = Country::create([
            'name' => 'Сенегал',
        ]);

        $country = Country::create([
            'name' => '«Сеута и Мелилья» Испания',
        ]);

        $country = Country::create([
            'name' => 'Сомали',
        ]);

        $country = Country::create([
            'name' => 'Судан',
        ]);

        $country = Country::create([
            'name' => 'Сьерра-Леоне',
        ]);

        $country = Country::create([
            'name' => 'Танзания',
        ]);

        $country = Country::create([
            'name' => 'Того',
        ]);

        $country = Country::create([
            'name' => 'Тунис',
        ]);

        $country = Country::create([
            'name' => 'Уганда',
        ]);

        $country = Country::create([
            'name' => 'ЧАД',
        ]);

        $country = Country::create([
            'name' => 'Центрально-Африканская республика',
        ]);

        $country = Country::create([
            'name' => 'Экваториальная Гвинея',
        ]);

        $country = Country::create([
            'name' => 'Эритрея',
        ]);

        $country = Country::create([
            'name' => 'Эфиопия',
        ]);

        $country = Country::create([
            'name' => 'Южно-Африканская Республика',
        ]);

        $country = Country::create([
            'name' => 'Австрия',
        ]);

        $country = Country::create([
            'name' => 'Андорра',
        ]);

        $country = Country::create([
            'name' => 'Албания',
        ]);

        $country = Country::create([
            'name' => 'Беларусь',
        ]);

        $country = Country::create([
            'name' => 'Бельгия',
        ]);

        $country = Country::create([
            'name' => 'Болгария',
        ]);

        $country = Country::create([
            'name' => 'Босния и Герцеговина',
        ]);

        $country = Country::create([
            'name' => 'Ватикан',
        ]);

        $country = Country::create([
            'name' => 'Великобритания',
        ]);

        $country = Country::create([
            'name' => 'Венгрия',
        ]);

        $country = Country::create([
            'name' => 'Германия',
        ]);

        $country = Country::create([
            'name' => 'Гибралтар',
        ]);

        $country = Country::create([
            'name' => 'Греция',
        ]);

        $country = Country::create([
            'name' => 'Дания',
        ]);

        $country = Country::create([
            'name' => 'Ирландия',
        ]);

        $country = Country::create([
            'name' => 'Исландия',
        ]);

        $country = Country::create([
            'name' => 'Испания',
        ]);

        $country = Country::create([
            'name' => 'Италия',
        ]);

        $country = Country::create([
            'name' => 'Латвия',
        ]);

        $country = Country::create([
            'name' => 'Литва',
        ]);

        $country = Country::create([
            'name' => 'Лихтенштейн',
        ]);

        $country = Country::create([
            'name' => 'Люксембург',
        ]);

        $country = Country::create([
            'name' => 'Македония',
        ]);

        $country = Country::create([
            'name' => 'Мальта',
        ]);

        $country = Country::create([
            'name' => 'Молдавия',
        ]);

        $country = Country::create([
            'name' => 'Монако',
        ]);

        $country = Country::create([
            'name' => 'Нидерланды',
        ]);

        $country = Country::create([
            'name' => 'Норвегия',
        ]);

        $country = Country::create([
            'name' => 'Польша',
        ]);

        $country = Country::create([
            'name' => 'Португалия',
        ]);

        $country = Country::create([
            'name' => 'Россия',
        ]);

        $country = Country::create([
            'name' => 'Румыния',
        ]);

        $country = Country::create([
            'name' => 'Сан-Марино',
        ]);

        $country = Country::create([
            'name' => 'Сербия и Черногория',
        ]);

        $country = Country::create([
            'name' => 'Словакия',
        ]);

        $country = Country::create([
            'name' => 'Словения',
        ]);

        $country = Country::create([
            'name' => 'Украина',
        ]);

        $country = Country::create([
            'name' => 'Фарерские острова',
        ]);

        $country = Country::create([
            'name' => 'Финляндия',
        ]);

        $country = Country::create([
            'name' => 'Франция',
        ]);

        $country = Country::create([
            'name' => 'Хорватия',
        ]);

        $country = Country::create([
            'name' => 'Черногория',
        ]);

        $country = Country::create([
            'name' => 'Чехия',
        ]);

        $country = Country::create([
            'name' => 'Швейцария',
        ]);

        $country = Country::create([
            'name' => 'Швеция',
        ]);

        $country = Country::create([
            'name' => 'Эстония',
        ]);

        $country = Country::create([
            'name' => 'Австралия',
        ]);

        $country = Country::create([
            'name' => 'Вануату',
        ]);

        $country = Country::create([
            'name' => 'Гуам',
        ]);

        $country = Country::create([
            'name' => 'Восточное (Американское) Самоа',
        ]);

        $country = Country::create([
            'name' => 'Западное Самоа',
        ]);

        $country = Country::create([
            'name' => 'Кирибати',
        ]);

        $country = Country::create([
            'name' => 'Кокосовые острова',
        ]);

        $country = Country::create([
            'name' => 'Кука острова',
        ]);

        $country = Country::create([
            'name' => 'Маршаловы острова',
        ]);

        $country = Country::create([
            'name' => 'Мидуэй',
        ]);

        $country = Country::create([
            'name' => 'Микронезия',
        ]);

        $country = Country::create([
            'name' => 'Науру',
        ]);

        $country = Country::create([
            'name' => 'Ниуэ',
        ]);

        $country = Country::create([
            'name' => 'Новая Зеландия',
        ]);

        $country = Country::create([
            'name' => 'Новая Каледония',
        ]);

        $country = Country::create([
            'name' => 'Норфолк',
        ]);

        $country = Country::create([
            'name' => 'Палау',
        ]);

        $country = Country::create([
            'name' => 'Папуа-Новая Гвинея',
        ]);

        $country = Country::create([
            'name' => 'Питкэрн',
        ]);

        $country = Country::create([
            'name' => 'Рождества остров',
        ]);

        $country = Country::create([
            'name' => 'Северные Марианские острова',
        ]);

        $country = Country::create([
            'name' => 'Токелау',
        ]);

        $country = Country::create([
            'name' => 'Тонга',
        ]);

        $country = Country::create([
            'name' => 'Тувалу',
        ]);

        $country = Country::create([
            'name' => 'Уоллис и Футуна',
        ]);

        $country = Country::create([
            'name' => 'Уэйк',
        ]);

        $country = Country::create([
            'name' => 'Фиджи',
        ]);

        $country = Country::create([
            'name' => 'Французская полинезия',
        ]);

        $country = Country::create([
            'name' => 'Гренландия',
        ]);

        $country = Country::create([
            'name' => 'Канада',
        ]);

        $country = Country::create([
            'name' => 'Мексика',
        ]);

        $country = Country::create([
            'name' => 'Сен-Пьер и Микелон',
        ]);

        $country = Country::create([
            'name' => 'США',
        ]);

        $country = Country::create([
            'name' => 'Ангилья (Ангуилла)',
        ]);

        $country = Country::create([
            'name' => 'Антигуа и Барбуда',
        ]);

        $country = Country::create([
            'name' => 'Нидерландские Антиллы',
        ]);

        $country = Country::create([
            'name' => 'Аруба',
        ]);

        $country = Country::create([
            'name' => 'Багамские острова',
        ]);

        $country = Country::create([
            'name' => 'Барбадос',
        ]);

        $country = Country::create([
            'name' => 'Белиз',
        ]);

        $country = Country::create([
            'name' => 'Бермудские острова',
        ]);

        $country = Country::create([
            'name' => 'Британские Виргинские острова',
        ]);

        $country = Country::create([
            'name' => 'Виргинские острова',
        ]);

        $country = Country::create([
            'name' => 'Гаити',
        ]);

        $country = Country::create([
            'name' => 'Гваделупа',
        ]);

        $country = Country::create([
            'name' => 'Гватемала',
        ]);

        $country = Country::create([
            'name' => 'Гондурас',
        ]);

        $country = Country::create([
            'name' => 'Гренада',
        ]);

        $country = Country::create([
            'name' => 'Доминика',
        ]);

        $country = Country::create([
            'name' => 'Доминиканская республика',
        ]);

        $country = Country::create([
            'name' => 'Каймановы острова',
        ]);

        $country = Country::create([
            'name' => 'Коста-Рика',
        ]);

        $country = Country::create([
            'name' => 'Куба',
        ]);

        $country = Country::create([
            'name' => 'Мартиника',
        ]);

        $country = Country::create([
            'name' => 'Монтсеррат',
        ]);

        $country = Country::create([
            'name' => 'Никарагуа',
        ]);

        $country = Country::create([
            'name' => 'Панама',
        ]);

        $country = Country::create([
            'name' => 'Пуэрто-Рико',
        ]);

        $country = Country::create([
            'name' => 'Сальвадор',
        ]);

        $country = Country::create([
            'name' => 'Сент-Винсент и Гренадины',
        ]);

        $country = Country::create([
            'name' => 'Сент-Китс и Невис',
        ]);

        $country = Country::create([
            'name' => 'Сент-Люсия',
        ]);

        $country = Country::create([
            'name' => 'Тёркс и Кайкос',
        ]);

        $country = Country::create([
            'name' => 'Тринидад и Тобаго',
        ]);

        $country = Country::create([
            'name' => 'Ямайка',
        ]);

        $country = Country::create([
            'name' => 'Аргентина',
        ]);

        $country = Country::create([
            'name' => 'Боливия',
        ]);

        $country = Country::create([
            'name' => 'Бразилия',
        ]);

        $country = Country::create([
            'name' => 'Венесуэла',
        ]);

        $country = Country::create([
            'name' => 'Гайана',
        ]);

        $country = Country::create([
            'name' => '«Гвиана» Франция',
        ]);

        $country = Country::create([
            'name' => 'Колумбия',
        ]);

        $country = Country::create([
            'name' => 'Парагвай',
        ]);

        $country = Country::create([
            'name' => 'Перу',
        ]);

        $country = Country::create([
            'name' => 'Суринам',
        ]);

        $country = Country::create([
            'name' => 'Уругвай',
        ]);

        $country = Country::create([
            'name' => 'Фолклендские (Мальвинские) острова',
        ]);

        $country = Country::create([
            'name' => 'Чили',
        ]);

        $country = Country::create([
            'name' => 'Эквадор',
        ]);
    }
}
