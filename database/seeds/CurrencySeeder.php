<?php

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('currencies')->delete();
        Currency::create(['currency' => 'ليرة لبنانية', 'abbr' => 'L.L', 'Country' => 'Lebanon', 'symbol' => '£', 'active' => 1]);
       Currency::create(['currency' => 'Leke', 'abbr' => 'ALL', 'Country' => 'Albania', 'symbol' => 'Lek', 'active' => 0]);
        Currency::create(['currency' => 'Dollars', 'abbr' => 'USD', 'Country' => 'America', 'symbol' => '$', 'active' => 1]);
        // Currency::create(['currency' => 'Afghanis', 'abbr' => 'AFN', 'Country' => 'Afghanistan', 'symbol' => '؋', 'active' => 0]);
        // Currency::create(['currency' => 'Pesos', 'abbr' => 'ARS', 'Country' => 'Argentina', 'symbol' => '$', 'active' => 0]);
        // Currency::create(['currency' => 'Guilders', 'abbr' => 'AWG', 'Country' => 'Aruba', 'symbol' => 'ƒ', 'active' => 0]);
        // Currency::create(['currency' => 'Dollars', 'abbr' => 'AUD', 'Country' => 'Australia', 'symbol' => '$', 'active' => 0]);
        // Currency::create(['currency' => 'New Manats', 'abbr' => 'AZN', 'Country' => 'Azerbaijan', 'symbol' => 'ман', 'active' => 0]);
        // Currency::create(['currency' => 'Dollars', 'abbr' => 'BSD', 'Country' => 'Bahamas', 'symbol' => '$', 'active' => 0]);
        // Currency::create(['currency' => 'Dollars', 'abbr' => 'BBD', 'Country' => 'Barbados', 'symbol' => '$', 'active' => 0]);
        // Currency::create(['currency' => 'Rubles', 'abbr' => 'BYR', 'Country' => 'Belarus', 'symbol' => 'p.', 'active' => 0]);
        // Currency::create(['currency' => 'Euro', 'abbr' => 'EUR', 'Country' => 'Belgium', 'symbol' => '€', 'active' => 0]);
        // Currency::create(['currency' => 'Dollars', 'abbr' => 'BZD', 'Country' => 'Beliz', 'symbol' => 'BZ$', 'active' => 0]);
        // Currency::create(['currency' => 'Dollars', 'abbr' => 'BMD', 'Country' => 'Bermuda', 'symbol' => '$', 'active' => 0]);
        // Currency::create(['currency' => 'Bolivianos', 'abbr' => 'BOB', 'Country' => 'Bolivia', 'symbol' => '$b', 'active' => 0]);
        // Currency::create(['currency' => 'Convertible Marka', 'abbr' => 'BAM', 'Country' => 'Bosnia and Herzegovina', 'symbol' => 'KM', 'active' => 0]);
        // Currency::create(['currency' => 'Pula', 'abbr' => 'BWP', 'Country' => 'Botswana', 'symbol' => 'P', 'active' => 0]);
        // Currency::create(['currency' => 'Leva', 'abbr' => 'BGN', 'Country' => 'Bulgaria', 'symbol' => 'лв', 'active' => 0]);
        // Currency::create(['currency' => 'Reais', 'abbr' => 'BRL', 'Country' => 'Brazil', 'symbol' => 'R$', 'active' => 0]);
        // Currency::create(['currency' => 'Pounds', 'abbr' => 'GBP', 'Country' => 'Britain (United Kingdom)', 'symbol' => '£', 'active' => 0]);
        // Currency::create(['currency' => 'Dollars', 'abbr' => 'BND', 'Country' => 'Brunei Darussalam', 'symbol' => '$', 'active' => 0]);
        // Currency::create(['currency' => 'Riels', 'abbr' => 'KHR', 'Country' => 'Cambodia', 'symbol' => '៛', 'active' => 0]);
        // Currency::create(['currency' => 'Dollars', 'abbr' => 'CAD', 'Country' => 'Canada', 'symbol' => '$', 'active' => 0]);
        // Currency::create(['currency' => 'Dollars', 'abbr' => 'KYD', 'Country' => 'Cayman Islands', 'symbol' => '$', 'active' => 0]);
        // Currency::create(['currency' => 'Pesos', 'abbr' => 'CLP', 'Country' => 'Chile', 'symbol' => '$', 'active' => 0]);
        // Currency::create(['currency' => 'Yuan Renminbi', 'abbr' => 'CNY', 'Country' => 'China', 'symbol' => '¥', 'active' => 0]);
        // Currency::create(['currency' => 'Pesos', 'abbr' => 'COP', 'Country' => 'Colombia', 'symbol' => '$', 'active' => 0]);
        // Currency::create(['currency' => 'Colón', 'abbr' => 'CRC', 'Country' => 'Costa Rica', 'symbol' => '₡', 'active' => 0]);
        // Currency::create(['currency' => 'Kuna', 'abbr' => 'HRK', 'Country' => 'Croatia', 'symbol' => 'kn', 'active' => 0]);
        // Currency::create(['currency' => 'Pesos', 'abbr' => 'CUP', 'Country' => 'Cuba', 'symbol' => '₱', 'active' => 0]);
        // Currency::create(['currency' => 'Euro', 'abbr' => 'EUR', 'Country' => 'Cyprus', 'symbol' => '€', 'active' => 0]);
        // Currency::create(['currency' => 'Koruny', 'abbr' => 'CZK', 'Country' => 'Czech Republic', 'symbol' => 'Kč', 'active' => 0]);
        // Currency::create(['currency' => 'Kroner', 'abbr' => 'DKK', 'Country' => 'Denmark', 'symbol' => 'kr', 'active' => 0]);
        // Currency::create(['currency' => 'Pesos', 'abbr' => 'DOP', 'Country' => 'Dominican Republic', 'symbol' => 'RD$', 'active' => 0]);
        // Currency::create(['currency' => 'Dollars', 'abbr' => 'XCD', 'Country' => 'East Caribbean', 'symbol' => '$', 'active' => 0]);
        // Currency::create(['currency' => 'Pounds', 'abbr' => 'EGP', 'Country' => 'Egypt', 'symbol' => '£', 'active' => 0]);
        // Currency::create(['currency' => 'Colones', 'abbr' => 'SVC', 'Country' => 'El Salvador', 'symbol' => '$', 'active' => 0]);
        // Currency::create(['currency' => 'Pounds', 'abbr' => 'GBP', 'Country' => 'England (United Kingdom)', 'symbol' => '£', 'active' => 0]);
        // Currency::create(['currency' => 'Euro', 'abbr' => 'EUR', 'Country' => 'Euro', 'symbol' => '€', 'active' => 0]);
        // Currency::create(['currency' => 'Pounds', 'abbr' => 'FKP', 'Country' => 'Falkland Islands', 'symbol' => '£', 'active' => 0]);
        // Currency::create(['currency' => 'Dollars', 'abbr' => 'FJD', 'Country' => 'Fiji', 'symbol' => '$', 'active' => 0]);
        // Currency::create(['currency' => 'Euro', 'abbr' => 'EUR', 'Country' => 'France', 'symbol' => '€', 'active' => 0]);
        // Currency::create(['currency' => 'Cedis', 'abbr' => 'GHC', 'Country' => 'Ghana', 'symbol' => '¢', 'active' => 0]);
        // Currency::create(['currency' => 'Pounds', 'abbr' => 'GIP', 'Country' => 'Gibraltar', 'symbol' => '£', 'active' => 0]);
        // Currency::create(['currency' => 'Euro', 'abbr' => 'EUR', 'Country' => 'Greece', 'symbol' => '€', 'active' => 0]);
        // Currency::create(['currency' => 'Quetzales', 'abbr' => 'GTQ', 'Country' => 'Guatemala', 'symbol' => 'Q', 'active' => 0]);
        // Currency::create(['currency' => 'Pounds', 'abbr' => 'GGP', 'Country' => 'Guernsey', 'symbol' => '£', 'active' => 0]);
        // Currency::create(['currency' => 'Dollars', 'abbr' => 'GYD', 'Country' => 'Guyana', 'symbol' => '$', 'active' => 0]);
        // Currency::create(['currency' => 'Euro', 'abbr' => 'EUR', 'Country' => 'Holland (Netherlands)', 'symbol' => '€', 'active' => 0]);
        // Currency::create(['currency' => 'Lempiras', 'abbr' => 'HNL', 'Country' => 'Honduras', 'symbol' => 'L', 'active' => 0]);
        // Currency::create(['currency' => 'Dollars', 'abbr' => 'HKD', 'Country' => 'Hong Kong', 'symbol' => '$', 'active' => 0]);
        // Currency::create(['currency' => 'Forint', 'abbr' => 'HUF', 'Country' => 'Hungary', 'symbol' => 'Ft', 'active' => 0]);
        // Currency::create(['currency' => 'Kronur', 'abbr' => 'ISK', 'Country' => 'Iceland', 'symbol' => 'kr', 'active' => 0]);
        // Currency::create(['currency' => 'Rupees', 'abbr' => 'INR', 'Country' => 'India', 'symbol' => 'Rp', 'active' => 0]);
        // Currency::create(['currency' => 'Rupiahs', 'abbr' => 'IDR', 'Country' => 'Indonesia', 'symbol' => 'Rp', 'active' => 0]);
        // Currency::create(['currency' => 'Rials', 'abbr' => 'IRR', 'Country' => 'Iran', 'symbol' => '﷼', 'active' => 0]);
        // Currency::create(['currency' => 'Euro', 'abbr' => 'EUR', 'Country' => 'Ireland', 'symbol' => '€', 'active' => 0]);
        // Currency::create(['currency' => 'Pounds', 'abbr' => 'IMP', 'Country' => 'Isle of Man', 'symbol' => '£', 'active' => 0]);
        // Currency::create(['currency' => 'New Shekels', 'abbr' => 'ILS', 'Country' => 'Israel', 'symbol' => '₪', 'active' => 0]);
        // Currency::create(['currency' => 'Euro', 'abbr' => 'EUR', 'Country' => 'Italy', 'symbol' => '€', 'active' => 0]);
        // Currency::create(['currency' => 'Dollars', 'abbr' => 'JMD', 'Country' => 'Jamaica', 'symbol' => 'J$', 'active' => 0]);
        // Currency::create(['currency' => 'Yen', 'abbr' => 'JPY', 'Country' => 'Japan', 'symbol' => '¥', 'active' => 0]);
        // Currency::create(['currency' => 'Pounds', 'abbr' => 'JEP', 'Country' => 'Jersey', 'symbol' => '£', 'active' => 0]);
        // Currency::create(['currency' => 'Tenge', 'abbr' => 'KZT', 'Country' => 'Kazakhstan', 'symbol' => 'лв', 'active' => 0]);
        // Currency::create(['currency' => 'Won', 'abbr' => 'KPW', 'Country' => 'Korea (North)', 'symbol' => '₩', 'active' => 0]);
        // Currency::create(['currency' => 'Won', 'abbr' => 'KRW', 'Country' => 'Korea (South)', 'symbol' => '₩', 'active' => 0]);
        // Currency::create(['currency' => 'Soms', 'abbr' => 'KGS', 'Country' => 'Kyrgyzstan', 'symbol' => 'лв', 'active' => 0]);
        // Currency::create(['currency' => 'Kips', 'abbr' => 'LAK', 'Country' => 'Laos', 'symbol' => '₭', 'active' => 0]);
        // Currency::create(['currency' => 'Lati', 'abbr' => 'LVL', 'Country' => 'Latvia', 'symbol' => 'Ls', 'active' => 0]);
        // Currency::create(['currency' => 'Pounds', 'abbr' => 'LBP', 'Country' => 'Lebanon', 'symbol' => '£', 'active' => 0]);
        // Currency::create(['currency' => 'Dollars', 'abbr' => 'LRD', 'Country' => 'Liberia', 'symbol' => '$', 'active' => 0]);
        // Currency::create(['currency' => 'Switzerland Francs', 'abbr' => 'CHF', 'Country' => 'Liechtenstein', 'symbol' => 'CHF', 'active' => 0]);
        // Currency::create(['currency' => 'Litai', 'abbr' => 'LTL', 'Country' => 'Lithuania', 'symbol' => 'Lt', 'active' => 0]);
        // Currency::create(['currency' => 'Euro', 'abbr' => 'EUR', 'Country' => 'Luxembourg', 'symbol' => '€', 'active' => 0]);
        // Currency::create(['currency' => 'Denars', 'abbr' => 'MKD', 'Country' => 'Macedonia', 'symbol' => 'ден', 'active' => 0]);
        // Currency::create(['currency' => 'Ringgits', 'abbr' => 'MYR', 'Country' => 'Malaysia', 'symbol' => 'RM', 'active' => 0]);
        // Currency::create(['currency' => 'Euro', 'abbr' => 'EUR', 'Country' => 'Malta', 'symbol' => '€', 'active' => 0]);
        // Currency::create(['currency' => 'Rupees', 'abbr' => 'MUR', 'Country' => 'Mauritius', 'symbol' => '₨', 'active' => 0]);
        // Currency::create(['currency' => 'Pesos', 'abbr' => 'MXN', 'Country' => 'Mexico', 'symbol' => '$', 'active' => 0]);
        // Currency::create(['currency' => 'Tugriks', 'abbr' => 'MNT', 'Country' => 'Mongolia', 'symbol' => '₮', 'active' => 0]);
        // Currency::create(['currency' => 'Meticais', 'abbr' => 'MZN', 'Country' => 'Mozambique', 'symbol' => 'MT', 'active' => 0]);
        // Currency::create(['currency' => 'Dollars', 'abbr' => 'NAD', 'Country' => 'Namibia', 'symbol' => '$', 'active' => 0]);
        // Currency::create(['currency' => 'Rupees', 'abbr' => 'NPR', 'Country' => 'Nepal', 'symbol' => '₨', 'active' => 0]);
        // Currency::create(['currency' => 'Guilders', 'abbr' => 'ANG', 'Country' => 'Netherlands Antilles', 'symbol' => 'ƒ', 'active' => 0]);
        // Currency::create(['currency' => 'Euro', 'abbr' => 'EUR', 'Country' => 'Netherlands', 'symbol' => '€', 'active' => 0]);
        // Currency::create(['currency' => 'Dollars', 'abbr' => 'NZD', 'Country' => 'New Zealand', 'symbol' => '$', 'active' => 0]);
        // Currency::create(['currency' => 'Cordobas', 'abbr' => 'NIO', 'Country' => 'Nicaragua', 'symbol' => 'C$', 'active' => 0]);
        // Currency::create(['currency' => 'Nairas', 'abbr' => 'NGN', 'Country' => 'Nigeria', 'symbol' => '₦', 'active' => 0]);
        // Currency::create(['currency' => 'Won', 'abbr' => 'KPW', 'Country' => 'North Korea', 'symbol' => '₩', 'active' => 0]);
        // Currency::create(['currency' => 'Krone', 'abbr' => 'NOK', 'Country' => 'Norway', 'symbol' => 'kr', 'active' => 0]);
        // Currency::create(['currency' => 'Rials', 'abbr' => 'OMR', 'Country' => 'Oman', 'symbol' => '﷼', 'active' => 0]);
        // Currency::create(['currency' => 'Rupees', 'abbr' => 'PKR', 'Country' => 'Pakistan', 'symbol' => '₨', 'active' => 0]);
        // Currency::create(['currency' => 'Balboa', 'abbr' => 'PAB', 'Country' => 'Panama', 'symbol' => 'B/.', 'active' => 0]);
        // Currency::create(['currency' => 'Guarani', 'abbr' => 'PYG', 'Country' => 'Paraguay', 'symbol' => 'Gs', 'active' => 0]);
        // Currency::create(['currency' => 'Nuevos Soles', 'abbr' => 'PEN', 'Country' => 'Peru', 'symbol' => 'S/.', 'active' => 0]);
        // Currency::create(['currency' => 'Pesos', 'abbr' => 'PHP', 'Country' => 'Philippines', 'symbol' => 'Php', 'active' => 0]);
        // Currency::create(['currency' => 'Zlotych', 'abbr' => 'PLN', 'Country' => 'Poland', 'symbol' => 'zł', 'active' => 0]);
        // Currency::create(['currency' => 'Rials', 'abbr' => 'QAR', 'Country' => 'Qatar', 'symbol' => '﷼', 'active' => 0]);
        // Currency::create(['currency' => 'New Lei', 'abbr' => 'RON', 'Country' => 'Romania', 'symbol' => 'lei', 'active' => 0]);
        // Currency::create(['currency' => 'Rubles', 'abbr' => 'RUB', 'Country' => 'Russia', 'symbol' => 'руб', 'active' => 0]);
        // Currency::create(['currency' => 'Pounds', 'abbr' => 'SHP', 'Country' => 'Saint Helena', 'symbol' => '£', 'active' => 0]);
        // Currency::create(['currency' => 'Riyals', 'abbr' => 'SAR', 'Country' => 'Saudi Arabia', 'symbol' => '﷼', 'active' => 0]);
        // Currency::create(['currency' => 'Dinars', 'abbr' => 'RSD', 'Country' => 'Serbia', 'symbol' => 'Дин.', 'active' => 0]);
        // Currency::create(['currency' => 'Rupees', 'abbr' => 'SCR', 'Country' => 'Seychelles', 'symbol' => '₨', 'active' => 0]);
        // Currency::create(['currency' => 'Dollars', 'abbr' => 'SGD', 'Country' => 'Singapore', 'symbol' => '$', 'active' => 0]);
        // Currency::create(['currency' => 'Euro', 'abbr' => 'EUR', 'Country' => 'Slovenia', 'symbol' => '€', 'active' => 0]);
        // Currency::create(['currency' => 'Dollars', 'abbr' => 'SBD', 'Country' => 'Solomon Islands', 'symbol' => '$', 'active' => 0]);
        // Currency::create(['currency' => 'Shillings', 'abbr' => 'SOS', 'Country' => 'Somalia', 'symbol' => 'S', 'active' => 0]);
        // Currency::create(['currency' => 'Rand', 'abbr' => 'ZAR', 'Country' => 'South Africa', 'symbol' => 'R', 'active' => 0]);
        // Currency::create(['currency' => 'Won', 'abbr' => 'KRW', 'Country' => 'South Korea', 'symbol' => '₩', 'active' => 0]);
        // Currency::create(['currency' => 'Euro', 'abbr' => 'EUR', 'Country' => 'Spain', 'symbol' => '€', 'active' => 0]);
        // Currency::create(['currency' => 'Rupees', 'abbr' => 'LKR', 'Country' => 'Sri Lanka', 'symbol' => '₨', 'active' => 0]);
        // Currency::create(['currency' => 'Kronor', 'abbr' => 'SEK', 'Country' => 'Sweden', 'symbol' => 'kr', 'active' => 0]);
        // Currency::create(['currency' => 'Francs', 'abbr' => 'CHF', 'Country' => 'Switzerland', 'symbol' => 'CHF', 'active' => 0]);
        // Currency::create(['currency' => 'Dollars', 'abbr' => 'SRD', 'Country' => 'Suriname', 'symbol' => '$', 'active' => 0]);
        // Currency::create(['currency' => 'Pounds', 'abbr' => 'SYP', 'Country' => 'Syria', 'symbol' => '£', 'active' => 0]);
        // Currency::create(['currency' => 'New Dollars', 'abbr' => 'TWD', 'Country' => 'Taiwan', 'symbol' => 'NT$', 'active' => 0]);
        // Currency::create(['currency' => 'Baht', 'abbr' => 'THB', 'Country' => 'Thailand', 'symbol' => '฿', 'active' => 0]);
        // Currency::create(['currency' => 'Dollars', 'abbr' => 'TTD', 'Country' => 'Trinidad and Tobago', 'symbol' => 'TT$', 'active' => 0]);
        // Currency::create(['currency' => 'Lira', 'abbr' => 'TRY', 'Country' => 'Turkey', 'symbol' => 'TL', 'active' => 0]);
        // Currency::create(['currency' => 'Liras', 'abbr' => 'TRL', 'Country' => 'Turkey', 'symbol' => '£', 'active' => 0]);
        // Currency::create(['currency' => 'Dollars', 'abbr' => 'TVD', 'Country' => 'Tuvalu', 'symbol' => '$', 'active' => 0]);
        // Currency::create(['currency' => 'Hryvnia', 'abbr' => 'UAH', 'Country' => 'Ukraine', 'symbol' => '₴', 'active' => 0]);
        // Currency::create(['currency' => 'Pounds', 'abbr' => 'GBP', 'Country' => 'United Kingdom', 'symbol' => '£', 'active' => 0]);
        // Currency::create(['currency' => 'Dollars', 'abbr' => 'USD', 'Country' => 'United States of America', 'symbol' => '$', 'active' => 0]);
        // Currency::create(['currency' => 'Pesos', 'abbr' => 'UYU', 'Country' => 'Uruguay', 'symbol' => '$U', 'active' => 0]);
        // Currency::create(['currency' => 'Sums', 'abbr' => 'UZS', 'Country' => 'Uzbekistan', 'symbol' => 'лв', 'active' => 0]);
        // Currency::create(['currency' => 'Euro', 'abbr' => 'EUR', 'Country' => 'Vatican City', 'symbol' => '€', 'active' => 0]);
        // Currency::create(['currency' => 'Bolivares Fuertes', 'abbr' => 'VEF', 'Country' => 'Venezuela', 'symbol' => 'Bs', 'active' => 0]);
        // Currency::create(['currency' => 'Dong', 'abbr' => 'VND', 'Country' => 'Vietnam', 'symbol' => '₫', 'active' => 0]);
        // Currency::create(['currency' => 'Rials', 'abbr' => 'YER', 'Country' => 'Yemen', 'symbol' => '﷼', 'active' => 0]);
        // Currency::create(['currency' => 'Zimbabwe Dollars', 'abbr' => 'ZWD', 'Country' => 'Zimbabwe', 'symbol' => 'Z$', 'active' => 0]);
        // Currency::create(['currency' => 'Rupees', 'abbr' => 'INR', 'Country' => 'India', 'symbol' => '₹', 'active' => 0]);

    }
}
