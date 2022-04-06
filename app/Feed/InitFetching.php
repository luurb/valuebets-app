<?php

declare(strict_types=1);

namespace App\Feed;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\DomCrawler\Crawler;

class InitFetching
{
    private array $bookiesAddr = [
        '22bet' => [
            'https://en.surebet.com/valuebets?utf8=%E2%9C%93&selector%5Bmin_group_size%5D=10&selector%5Bsettled_in%5D=21600&selector%5Bmin_odds%5D=1.6&selector%5Bmax_odds%5D=6&selector%5Bmin_overvalue%5D=&selector%5Bmax_overvalue%5D=&selector%5Bmin_probability%5D=&selector%5Bmax_probability%5D=&selector%5Bbookies_settings%5D=0%3A67%3A%3A%3B0%3A71%3A%3A%3B0%3A66%3A%3A%3B0%3A74%3A%3A%3B0%3A73%3A%3A%3B4%3A146%3A%3A%3B0%3A70%3A%3A%3B0%3A112%3A%3A%3B0%3A130%3A%3A%3B0%3A124%3A%3A%3B0%3A21%3A%3A%3B0%3A26%3A%3A%3B0%3A137%3A%3A%3B0%3A148%3A%3A%3B0%3A149%3A%3A%3B0%3A23%3A%3A%3B0%3A0%3A%3A%3B0%3A32%3A%3A%3B0%3A159%3A%3A%3B0%3A102%3A%3A%3B0%3A29%3A%3A%3B0%3A10%3A%3A%3B0%3A45%3A%3A%3B0%3A163%3A%3A%3B0%3A178%3A%3A%3B0%3A14%3A%3A%3B0%3A11%3A%3A%3B0%3A38%3A%3A%3B0%3A55%3A%3A%3B0%3A33%3A%3A%3B0%3A174%3A%3A%3B0%3A123%3A%3A%3B0%3A49%3A%3A%3B0%3A62%3A%3A%3B0%3A12%3A%3A%3B0%3A46%3A%3A%3B0%3A144%3A%3A%3B0%3A115%3A%3A%3B0%3A133%3A%3A%3B0%3A24%3A%3A%3B0%3A85%3A%3A%3B0%3A72%3A%3A%3B0%3A127%3A%3A%3B0%3A143%3A%3A%3B0%3A134%3A%3A%3B0%3A106%3A%3A%3B0%3A5%3A%3A%3B0%3A6%3A%3A%3B0%3A173%3A%3A%3B0%3A4%3A%3A%3B0%3A30%3A%3A%3B0%3A15%3A%3A%3B0%3A126%3A%3A%3B0%3A50%3A%3A%3B0%3A9%3A%3A%3B0%3A177%3A%3A%3B0%3A176%3A%3A%3B0%3A41%3A%3A%3B0%3A128%3A%3A%3B0%3A131%3A%3A%3B0%3A3%3A%3A%3B0%3A8%3A%3A%3B0%3A116%3A%3A%3B0%3A86%3A%3A%3B0%3A164%3A%3A%3B0%3A122%3A%3A%3B0%3A165%3A%3A%3B0%3A160%3A%3A%3B0%3A162%3A%3A%3B0%3A39%3A%3A%3B0%3A172%3A%3A%3B0%3A31%3A%3A%3B0%3A51%3A%3A%3B0%3A179%3A%3A%3B0%3A2%3A%3A%3B0%3A152%3A%3A%3B0%3A157%3A%3A%3B0%3A141%3A%3A%3B0%3A7%3A%3A%3B0%3A108%3A%3A%3B0%3A142%3A%3A%3B0%3A121%3A%3A%3B0%3A25%3A%3A%3B0%3A69%3A%3A%3B0%3A138%3A%3A%3B0%3A117%3A%3A%3B0%3A161%3A%3A%3B0%3A171%3A%3A%3B0%3A43%3A%3A%3B0%3A18%3A%3A%3B0%3A158%3A%3A%3B0%3A59%3A%3A%3B0%3A83%3A%3A%3B0%3A118%3A%3A%3B0%3A147%3A%3A%3B0%3A125%3A%3A%3B0%3A89%3A%3A%3B0%3A17%3A%3A%3B0%3A107%3A%3A%3B0%3A53%3A%3A%3B0%3A153%3A%3A%3B0%3A28%3A%3A%3B0%3A44%3A%3A%3B0%3A27%3A%3A&selector%5Bexclude_sports_ids_str%5D=56+57+0+43+32+1+2+3+4+55+7+6+5+28+8+44+9+26+34+10+11+12+39+47+46+48+49+59+14+27+53+54+58+16+30+13+17+18+52+29+45+19+36+33+31+40+42+41+20+50+51+21+37+23+22+35+24+38+25&commit=Filter&narrow=',
            'https://en.surebet.com/valuebets?utf8=%E2%9C%93&selector%5Bmin_group_size%5D=10&selector%5Bsettled_in%5D=21600&selector%5Bmin_odds%5D=1.6&selector%5Bmax_odds%5D=6.0&selector%5Bmin_overvalue%5D=&selector%5Bmax_overvalue%5D=&selector%5Bmin_probability%5D=&selector%5Bmax_probability%5D=&selector%5Bbookies_settings%5D=0%3A67%3A%3A%3B0%3A71%3A%3A%3B0%3A66%3A%3A%3B0%3A74%3A%3A%3B0%3A73%3A%3A%3B4%3A146%3A%3A%3B0%3A70%3A%3A%3B0%3A112%3A%3A%3B0%3A130%3A%3A%3B0%3A124%3A%3A%3B0%3A21%3A%3A%3B0%3A26%3A%3A%3B0%3A137%3A%3A%3B0%3A148%3A%3A%3B0%3A149%3A%3A%3B0%3A23%3A%3A%3B0%3A0%3A%3A%3B0%3A32%3A%3A%3B0%3A159%3A%3A%3B0%3A102%3A%3A%3B0%3A29%3A%3A%3B0%3A10%3A%3A%3B0%3A45%3A%3A%3B0%3A163%3A%3A%3B0%3A178%3A%3A%3B0%3A14%3A%3A%3B0%3A11%3A%3A%3B0%3A38%3A%3A%3B0%3A55%3A%3A%3B0%3A33%3A%3A%3B0%3A174%3A%3A%3B0%3A123%3A%3A%3B0%3A49%3A%3A%3B0%3A62%3A%3A%3B0%3A12%3A%3A%3B0%3A46%3A%3A%3B0%3A144%3A%3A%3B0%3A115%3A%3A%3B0%3A133%3A%3A%3B0%3A24%3A%3A%3B0%3A85%3A%3A%3B0%3A72%3A%3A%3B0%3A127%3A%3A%3B0%3A143%3A%3A%3B0%3A134%3A%3A%3B0%3A106%3A%3A%3B0%3A5%3A%3A%3B0%3A6%3A%3A%3B0%3A173%3A%3A%3B0%3A4%3A%3A%3B0%3A30%3A%3A%3B0%3A15%3A%3A%3B0%3A126%3A%3A%3B0%3A50%3A%3A%3B0%3A9%3A%3A%3B0%3A177%3A%3A%3B0%3A176%3A%3A%3B0%3A41%3A%3A%3B0%3A128%3A%3A%3B0%3A131%3A%3A%3B0%3A3%3A%3A%3B0%3A8%3A%3A%3B0%3A116%3A%3A%3B0%3A86%3A%3A%3B0%3A164%3A%3A%3B0%3A122%3A%3A%3B0%3A165%3A%3A%3B0%3A160%3A%3A%3B0%3A162%3A%3A%3B0%3A39%3A%3A%3B0%3A172%3A%3A%3B0%3A31%3A%3A%3B0%3A51%3A%3A%3B0%3A179%3A%3A%3B0%3A2%3A%3A%3B0%3A152%3A%3A%3B0%3A157%3A%3A%3B0%3A141%3A%3A%3B0%3A7%3A%3A%3B0%3A108%3A%3A%3B0%3A142%3A%3A%3B0%3A121%3A%3A%3B0%3A25%3A%3A%3B0%3A69%3A%3A%3B0%3A138%3A%3A%3B0%3A117%3A%3A%3B0%3A161%3A%3A%3B0%3A171%3A%3A%3B0%3A43%3A%3A%3B0%3A18%3A%3A%3B0%3A158%3A%3A%3B0%3A59%3A%3A%3B0%3A83%3A%3A%3B0%3A118%3A%3A%3B0%3A147%3A%3A%3B0%3A125%3A%3A%3B0%3A89%3A%3A%3B0%3A17%3A%3A%3B0%3A107%3A%3A%3B0%3A53%3A%3A%3B0%3A153%3A%3A%3B0%3A28%3A%3A%3B0%3A44%3A%3A%3B0%3A27%3A%3A&selector%5Bexclude_sports_ids_str%5D=56+57+0+32+1+2+3+55+7+6+5+28+9+10+11+12+43+44+47+46+48+49+59+45+33+40+42+41+37+38+14+27+15+53+54+58+16+30+13+17+18+52+29+19+8+31+20+21+23+50+51+24+25+26&narrow=',
        ],
        'pinnacle' => [
            'https://en.surebet.com/valuebets?utf8=%E2%9C%93&selector%5Bmin_group_size%5D=10&selector%5Bsettled_in%5D=21600&selector%5Bmin_odds%5D=1.6&selector%5Bmax_odds%5D=6.0&selector%5Bmin_overvalue%5D=&selector%5Bmax_overvalue%5D=&selector%5Bmin_probability%5D=&selector%5Bmax_probability%5D=&selector%5Bbookies_settings%5D=0%3A67%3A%3A%3B0%3A71%3A%3A%3B0%3A66%3A%3A%3B0%3A74%3A%3A%3B0%3A73%3A%3A%3B0%3A146%3A%3A%3B0%3A70%3A%3A%3B0%3A112%3A%3A%3B0%3A130%3A%3A%3B0%3A124%3A%3A%3B0%3A21%3A%3A%3B0%3A26%3A%3A%3B0%3A137%3A%3A%3B0%3A148%3A%3A%3B0%3A149%3A%3A%3B0%3A23%3A%3A%3B0%3A0%3A%3A%3B0%3A32%3A%3A%3B0%3A159%3A%3A%3B0%3A102%3A%3A%3B0%3A29%3A%3A%3B0%3A10%3A%3A%3B0%3A45%3A%3A%3B0%3A163%3A%3A%3B0%3A178%3A%3A%3B0%3A14%3A%3A%3B0%3A11%3A%3A%3B0%3A38%3A%3A%3B0%3A55%3A%3A%3B0%3A33%3A%3A%3B0%3A174%3A%3A%3B0%3A123%3A%3A%3B0%3A49%3A%3A%3B0%3A62%3A%3A%3B0%3A12%3A%3A%3B0%3A46%3A%3A%3B0%3A144%3A%3A%3B0%3A115%3A%3A%3B0%3A133%3A%3A%3B0%3A24%3A%3A%3B0%3A85%3A%3A%3B0%3A72%3A%3A%3B0%3A127%3A%3A%3B0%3A143%3A%3A%3B0%3A134%3A%3A%3B0%3A106%3A%3A%3B0%3A5%3A%3A%3B0%3A6%3A%3A%3B0%3A173%3A%3A%3B0%3A4%3A%3A%3B0%3A30%3A%3A%3B0%3A15%3A%3A%3B0%3A126%3A%3A%3B0%3A50%3A%3A%3B0%3A9%3A%3A%3B0%3A177%3A%3A%3B0%3A176%3A%3A%3B0%3A41%3A%3A%3B0%3A128%3A%3A%3B0%3A131%3A%3A%3B0%3A3%3A%3A%3B0%3A8%3A%3A%3B0%3A116%3A%3A%3B0%3A86%3A%3A%3B0%3A164%3A%3A%3B0%3A122%3A%3A%3B0%3A165%3A%3A%3B0%3A160%3A%3A%3B0%3A162%3A%3A%3B0%3A39%3A%3A%3B0%3A172%3A%3A%3B0%3A31%3A%3A%3B0%3A51%3A%3A%3B0%3A179%3A%3A%3B0%3A2%3A%3A%3B0%3A152%3A%3A%3B0%3A157%3A%3A%3B0%3A141%3A%3A%3B4%3A7%3A%3A%3B0%3A108%3A%3A%3B0%3A142%3A%3A%3B0%3A121%3A%3A%3B0%3A25%3A%3A%3B0%3A69%3A%3A%3B0%3A138%3A%3A%3B0%3A117%3A%3A%3B0%3A161%3A%3A%3B0%3A171%3A%3A%3B0%3A43%3A%3A%3B0%3A18%3A%3A%3B0%3A158%3A%3A%3B0%3A59%3A%3A%3B0%3A83%3A%3A%3B0%3A118%3A%3A%3B0%3A147%3A%3A%3B0%3A125%3A%3A%3B0%3A89%3A%3A%3B0%3A17%3A%3A%3B0%3A107%3A%3A%3B0%3A53%3A%3A%3B0%3A153%3A%3A%3B0%3A28%3A%3A%3B0%3A44%3A%3A%3B0%3A27%3A%3A&selector%5Bexclude_sports_ids_str%5D=56+57+0+32+1+2+3+4+55+7+6+5+28+9+10+11+12+43+44+34+39+47+46+48+49+59+45+36+33+40+42+41+37+35+38+14+27+53+54+58+16+30+13+17+18+52+29+19+8+31+20+21+23+22+50+51+24+25+26&narrow=',
            'https://en.surebet.com/valuebets?utf8=%E2%9C%93&selector%5Bmin_group_size%5D=10&selector%5Bsettled_in%5D=21600&selector%5Bmin_odds%5D=1.6&selector%5Bmax_odds%5D=6.0&selector%5Bmin_overvalue%5D=&selector%5Bmax_overvalue%5D=&selector%5Bmin_probability%5D=&selector%5Bmax_probability%5D=&selector%5Bbookies_settings%5D=0%3A67%3A%3A%3B0%3A71%3A%3A%3B0%3A66%3A%3A%3B0%3A74%3A%3A%3B0%3A73%3A%3A%3B0%3A146%3A%3A%3B0%3A70%3A%3A%3B0%3A112%3A%3A%3B0%3A130%3A%3A%3B0%3A124%3A%3A%3B0%3A21%3A%3A%3B0%3A26%3A%3A%3B0%3A137%3A%3A%3B0%3A148%3A%3A%3B0%3A149%3A%3A%3B0%3A23%3A%3A%3B0%3A0%3A%3A%3B0%3A32%3A%3A%3B0%3A159%3A%3A%3B0%3A102%3A%3A%3B0%3A29%3A%3A%3B0%3A10%3A%3A%3B0%3A45%3A%3A%3B0%3A163%3A%3A%3B0%3A178%3A%3A%3B0%3A14%3A%3A%3B0%3A11%3A%3A%3B0%3A38%3A%3A%3B0%3A55%3A%3A%3B0%3A33%3A%3A%3B0%3A174%3A%3A%3B0%3A123%3A%3A%3B0%3A49%3A%3A%3B0%3A62%3A%3A%3B0%3A12%3A%3A%3B0%3A46%3A%3A%3B0%3A144%3A%3A%3B0%3A115%3A%3A%3B0%3A133%3A%3A%3B0%3A24%3A%3A%3B0%3A85%3A%3A%3B0%3A72%3A%3A%3B0%3A127%3A%3A%3B0%3A143%3A%3A%3B0%3A134%3A%3A%3B0%3A106%3A%3A%3B0%3A5%3A%3A%3B0%3A6%3A%3A%3B0%3A173%3A%3A%3B0%3A4%3A%3A%3B0%3A30%3A%3A%3B0%3A15%3A%3A%3B0%3A126%3A%3A%3B0%3A50%3A%3A%3B0%3A9%3A%3A%3B0%3A177%3A%3A%3B0%3A176%3A%3A%3B0%3A41%3A%3A%3B0%3A128%3A%3A%3B0%3A131%3A%3A%3B0%3A3%3A%3A%3B0%3A8%3A%3A%3B0%3A116%3A%3A%3B0%3A86%3A%3A%3B0%3A164%3A%3A%3B0%3A122%3A%3A%3B0%3A165%3A%3A%3B0%3A160%3A%3A%3B0%3A162%3A%3A%3B0%3A39%3A%3A%3B0%3A172%3A%3A%3B0%3A31%3A%3A%3B0%3A51%3A%3A%3B0%3A179%3A%3A%3B0%3A2%3A%3A%3B0%3A152%3A%3A%3B0%3A157%3A%3A%3B0%3A141%3A%3A%3B4%3A7%3A%3A%3B0%3A108%3A%3A%3B0%3A142%3A%3A%3B0%3A121%3A%3A%3B0%3A25%3A%3A%3B0%3A69%3A%3A%3B0%3A138%3A%3A%3B0%3A117%3A%3A%3B0%3A161%3A%3A%3B0%3A171%3A%3A%3B0%3A43%3A%3A%3B0%3A18%3A%3A%3B0%3A158%3A%3A%3B0%3A59%3A%3A%3B0%3A83%3A%3A%3B0%3A118%3A%3A%3B0%3A147%3A%3A%3B0%3A125%3A%3A%3B0%3A89%3A%3A%3B0%3A17%3A%3A%3B0%3A107%3A%3A%3B0%3A53%3A%3A%3B0%3A153%3A%3A%3B0%3A28%3A%3A%3B0%3A44%3A%3A%3B0%3A27%3A%3A&selector%5Bexclude_sports_ids_str%5D=56+57+0+32+1+2+3+55+7+6+5+28+9+10+11+12+43+44+47+46+48+49+59+45+33+40+42+41+37+38+14+27+15+53+54+58+16+30+13+17+18+52+29+19+8+31+20+21+23+50+51+24+25+26&narrow=',
        ],
        'ggbet' => [
            'https://en.surebet.com/valuebets?utf8=%E2%9C%93&selector%5Bmin_group_size%5D=10&selector%5Bsettled_in%5D=21600&selector%5Bmin_odds%5D=1.6&selector%5Bmax_odds%5D=6.0&selector%5Bmin_overvalue%5D=&selector%5Bmax_overvalue%5D=&selector%5Bmin_probability%5D=&selector%5Bmax_probability%5D=&selector%5Bbookies_settings%5D=0%3A67%3A%3A%3B0%3A71%3A%3A%3B0%3A66%3A%3A%3B0%3A74%3A%3A%3B0%3A73%3A%3A%3B0%3A146%3A%3A%3B0%3A70%3A%3A%3B0%3A112%3A%3A%3B0%3A130%3A%3A%3B0%3A124%3A%3A%3B0%3A21%3A%3A%3B0%3A23%3A%3A%3B0%3A26%3A%3A%3B0%3A137%3A%3A%3B0%3A148%3A%3A%3B0%3A149%3A%3A%3B0%3A123%3A%3A%3B0%3A%3A%3A%3B0%3A32%3A%3A%3B0%3A159%3A%3A%3B0%3A102%3A%3A%3B0%3A29%3A%3A%3B0%3A10%3A%3A%3B0%3A45%3A%3A%3B0%3A163%3A%3A%3B0%3A178%3A%3A%3B0%3A14%3A%3A%3B0%3A11%3A%3A%3B0%3A38%3A%3A%3B0%3A55%3A%3A%3B0%3A33%3A%3A%3B0%3A174%3A%3A%3B0%3A49%3A%3A%3B0%3A62%3A%3A%3B0%3A12%3A%3A%3B0%3A46%3A%3A%3B0%3A144%3A%3A%3B0%3A115%3A%3A%3B0%3A133%3A%3A%3B0%3A24%3A%3A%3B0%3A85%3A%3A%3B0%3A72%3A%3A%3B0%3A127%3A%3A%3B0%3A143%3A%3A%3B0%3A134%3A%3A%3B0%3A106%3A%3A%3B0%3A5%3A%3A%3B0%3A6%3A%3A%3B4%3A173%3A%3A%3B0%3A4%3A%3A%3B0%3A30%3A%3A%3B0%3A15%3A%3A%3B0%3A126%3A%3A%3B0%3A50%3A%3A%3B0%3A9%3A%3A%3B0%3A177%3A%3A%3B0%3A176%3A%3A%3B0%3A41%3A%3A%3B0%3A128%3A%3A%3B0%3A131%3A%3A%3B0%3A3%3A%3A%3B0%3A8%3A%3A%3B0%3A116%3A%3A%3B0%3A86%3A%3A%3B0%3A164%3A%3A%3B0%3A122%3A%3A%3B0%3A165%3A%3A%3B0%3A160%3A%3A%3B0%3A162%3A%3A%3B0%3A39%3A%3A%3B0%3A172%3A%3A%3B0%3A31%3A%3A%3B0%3A51%3A%3A%3B0%3A179%3A%3A%3B0%3A2%3A%3A%3B0%3A152%3A%3A%3B0%3A157%3A%3A%3B0%3A141%3A%3A%3B0%3A7%3A%3A%3B0%3A108%3A%3A%3B0%3A142%3A%3A%3B0%3A121%3A%3A%3B0%3A25%3A%3A%3B0%3A69%3A%3A%3B0%3A138%3A%3A%3B0%3A117%3A%3A%3B0%3A161%3A%3A%3B0%3A171%3A%3A%3B0%3A43%3A%3A%3B0%3A18%3A%3A%3B0%3A158%3A%3A%3B0%3A59%3A%3A%3B0%3A83%3A%3A%3B0%3A118%3A%3A%3B0%3A147%3A%3A%3B0%3A125%3A%3A%3B0%3A89%3A%3A%3B0%3A17%3A%3A%3B0%3A107%3A%3A%3B0%3A53%3A%3A%3B0%3A153%3A%3A%3B0%3A28%3A%3A%3B0%3A44%3A%3A%3B0%3A27%3A%3A&selector%5Bexclude_sports_ids_str%5D=56+57+0+43+32+1+2+3+4+55+7+6+5+28+8+44+9+26+34+10+11+12+39+47+46+48+49+59+14+27+53+54+58+16+30+13+17+18+52+29+45+19+36+33+31+40+42+41+20+50+51+21+37+23+22+35+24+38+25&narrow=',
            'https://en.surebet.com/valuebets?utf8=%E2%9C%93&selector%5Bmin_group_size%5D=10&selector%5Bsettled_in%5D=21600&selector%5Bmin_odds%5D=1.6&selector%5Bmax_odds%5D=6.0&selector%5Bmin_overvalue%5D=&selector%5Bmax_overvalue%5D=&selector%5Bmin_probability%5D=&selector%5Bmax_probability%5D=&selector%5Bbookies_settings%5D=0%3A67%3A%3A%3B0%3A71%3A%3A%3B0%3A66%3A%3A%3B0%3A74%3A%3A%3B0%3A73%3A%3A%3B0%3A146%3A%3A%3B0%3A70%3A%3A%3B0%3A112%3A%3A%3B0%3A130%3A%3A%3B0%3A124%3A%3A%3B0%3A21%3A%3A%3B0%3A26%3A%3A%3B0%3A137%3A%3A%3B0%3A148%3A%3A%3B0%3A149%3A%3A%3B0%3A23%3A%3A%3B0%3A0%3A%3A%3B0%3A32%3A%3A%3B0%3A159%3A%3A%3B0%3A102%3A%3A%3B0%3A29%3A%3A%3B0%3A10%3A%3A%3B0%3A45%3A%3A%3B0%3A163%3A%3A%3B0%3A178%3A%3A%3B0%3A14%3A%3A%3B0%3A11%3A%3A%3B0%3A38%3A%3A%3B0%3A55%3A%3A%3B0%3A33%3A%3A%3B0%3A174%3A%3A%3B0%3A123%3A%3A%3B0%3A49%3A%3A%3B0%3A62%3A%3A%3B0%3A12%3A%3A%3B0%3A46%3A%3A%3B0%3A144%3A%3A%3B0%3A115%3A%3A%3B0%3A133%3A%3A%3B0%3A24%3A%3A%3B0%3A85%3A%3A%3B0%3A72%3A%3A%3B0%3A127%3A%3A%3B0%3A143%3A%3A%3B0%3A134%3A%3A%3B0%3A106%3A%3A%3B0%3A5%3A%3A%3B0%3A6%3A%3A%3B4%3A173%3A%3A%3B0%3A4%3A%3A%3B0%3A30%3A%3A%3B0%3A15%3A%3A%3B0%3A126%3A%3A%3B0%3A50%3A%3A%3B0%3A9%3A%3A%3B0%3A177%3A%3A%3B0%3A176%3A%3A%3B0%3A41%3A%3A%3B0%3A128%3A%3A%3B0%3A131%3A%3A%3B0%3A3%3A%3A%3B0%3A8%3A%3A%3B0%3A116%3A%3A%3B0%3A86%3A%3A%3B0%3A164%3A%3A%3B0%3A122%3A%3A%3B0%3A165%3A%3A%3B0%3A160%3A%3A%3B0%3A162%3A%3A%3B0%3A39%3A%3A%3B0%3A172%3A%3A%3B0%3A31%3A%3A%3B0%3A51%3A%3A%3B0%3A179%3A%3A%3B0%3A2%3A%3A%3B0%3A152%3A%3A%3B0%3A157%3A%3A%3B0%3A141%3A%3A%3B0%3A7%3A%3A%3B0%3A108%3A%3A%3B0%3A142%3A%3A%3B0%3A121%3A%3A%3B0%3A25%3A%3A%3B0%3A69%3A%3A%3B0%3A138%3A%3A%3B0%3A117%3A%3A%3B0%3A161%3A%3A%3B0%3A171%3A%3A%3B0%3A43%3A%3A%3B0%3A18%3A%3A%3B0%3A158%3A%3A%3B0%3A59%3A%3A%3B0%3A83%3A%3A%3B0%3A118%3A%3A%3B0%3A147%3A%3A%3B0%3A125%3A%3A%3B0%3A89%3A%3A%3B0%3A17%3A%3A%3B0%3A107%3A%3A%3B0%3A53%3A%3A%3B0%3A153%3A%3A%3B0%3A28%3A%3A%3B0%3A44%3A%3A%3B0%3A27%3A%3A&selector%5Bexclude_sports_ids_str%5D=56+57+0+32+1+2+3+55+7+6+5+28+9+10+11+12+43+44+47+46+48+49+59+45+33+40+42+41+37+38+14+27+15+53+54+58+16+30+13+17+18+52+29+19+8+31+20+21+23+50+51+24+25+26&narrow=',
        ],
        'bet365' => [
            'https://en.surebet.com/valuebets?utf8=%E2%9C%93&selector%5Bmin_group_size%5D=10&selector%5Bsettled_in%5D=21600&selector%5Bmin_odds%5D=1.6&selector%5Bmax_odds%5D=6.0&selector%5Bmin_overvalue%5D=&selector%5Bmax_overvalue%5D=&selector%5Bmin_probability%5D=&selector%5Bmax_probability%5D=&selector%5Bbookies_settings%5D=0%3A67%3A%3A%3B0%3A71%3A%3A%3B0%3A66%3A%3A%3B0%3A74%3A%3A%3B0%3A73%3A%3A%3B0%3A146%3A%3A%3B0%3A70%3A%3A%3B0%3A112%3A%3A%3B0%3A130%3A%3A%3B0%3A124%3A%3A%3B0%3A21%3A%3A%3B0%3A23%3A%3A%3B4%3A26%3A%3A%3B0%3A137%3A%3A%3B0%3A148%3A%3A%3B0%3A149%3A%3A%3B0%3A123%3A%3A%3B0%3A%3A%3A%3B0%3A32%3A%3A%3B0%3A159%3A%3A%3B0%3A102%3A%3A%3B0%3A29%3A%3A%3B0%3A10%3A%3A%3B0%3A45%3A%3A%3B0%3A163%3A%3A%3B0%3A178%3A%3A%3B0%3A14%3A%3A%3B0%3A11%3A%3A%3B0%3A38%3A%3A%3B0%3A55%3A%3A%3B0%3A33%3A%3A%3B0%3A174%3A%3A%3B0%3A49%3A%3A%3B0%3A62%3A%3A%3B0%3A12%3A%3A%3B0%3A46%3A%3A%3B0%3A144%3A%3A%3B0%3A115%3A%3A%3B0%3A133%3A%3A%3B0%3A24%3A%3A%3B0%3A85%3A%3A%3B0%3A72%3A%3A%3B0%3A127%3A%3A%3B0%3A143%3A%3A%3B0%3A134%3A%3A%3B0%3A106%3A%3A%3B0%3A5%3A%3A%3B0%3A6%3A%3A%3B0%3A173%3A%3A%3B0%3A4%3A%3A%3B0%3A30%3A%3A%3B0%3A15%3A%3A%3B0%3A126%3A%3A%3B0%3A50%3A%3A%3B0%3A9%3A%3A%3B0%3A177%3A%3A%3B0%3A176%3A%3A%3B0%3A41%3A%3A%3B0%3A128%3A%3A%3B0%3A131%3A%3A%3B0%3A3%3A%3A%3B0%3A8%3A%3A%3B0%3A116%3A%3A%3B0%3A86%3A%3A%3B0%3A164%3A%3A%3B0%3A122%3A%3A%3B0%3A165%3A%3A%3B0%3A160%3A%3A%3B0%3A162%3A%3A%3B0%3A39%3A%3A%3B0%3A172%3A%3A%3B0%3A31%3A%3A%3B0%3A51%3A%3A%3B0%3A179%3A%3A%3B0%3A2%3A%3A%3B0%3A152%3A%3A%3B0%3A157%3A%3A%3B0%3A141%3A%3A%3B0%3A7%3A%3A%3B0%3A108%3A%3A%3B0%3A142%3A%3A%3B0%3A121%3A%3A%3B0%3A25%3A%3A%3B0%3A69%3A%3A%3B0%3A138%3A%3A%3B0%3A117%3A%3A%3B0%3A161%3A%3A%3B0%3A171%3A%3A%3B0%3A43%3A%3A%3B0%3A18%3A%3A%3B0%3A158%3A%3A%3B0%3A59%3A%3A%3B0%3A83%3A%3A%3B0%3A118%3A%3A%3B0%3A147%3A%3A%3B0%3A125%3A%3A%3B0%3A89%3A%3A%3B0%3A17%3A%3A%3B0%3A107%3A%3A%3B0%3A53%3A%3A%3B0%3A153%3A%3A%3B0%3A28%3A%3A%3B0%3A44%3A%3A%3B0%3A27%3A%3A&selector%5Bexclude_sports_ids_str%5D=56+57+0+43+32+1+2+3+55+7+6+5+28+8+44+9+26+10+11+12+47+46+48+49+59+14+27+15+53+54+58+16+30+13+17+18+52+29+45+19+33+31+40+42+41+20+50+51+21+37+23+24+38+25&narrow=',
            'https://en.surebet.com/valuebets?utf8=%E2%9C%93&selector%5Bmin_group_size%5D=10&selector%5Bsettled_in%5D=21600&selector%5Bmin_odds%5D=1.6&selector%5Bmax_odds%5D=6.0&selector%5Bmin_overvalue%5D=&selector%5Bmax_overvalue%5D=&selector%5Bmin_probability%5D=&selector%5Bmax_probability%5D=&selector%5Bbookies_settings%5D=0%3A67%3A%3A%3B0%3A71%3A%3A%3B0%3A66%3A%3A%3B0%3A74%3A%3A%3B0%3A73%3A%3A%3B0%3A146%3A%3A%3B0%3A70%3A%3A%3B0%3A112%3A%3A%3B0%3A130%3A%3A%3B0%3A124%3A%3A%3B0%3A21%3A%3A%3B4%3A26%3A%3A%3B0%3A137%3A%3A%3B0%3A148%3A%3A%3B0%3A149%3A%3A%3B0%3A23%3A%3A%3B0%3A0%3A%3A%3B0%3A32%3A%3A%3B0%3A159%3A%3A%3B0%3A102%3A%3A%3B0%3A29%3A%3A%3B0%3A10%3A%3A%3B0%3A45%3A%3A%3B0%3A163%3A%3A%3B0%3A178%3A%3A%3B0%3A14%3A%3A%3B0%3A11%3A%3A%3B0%3A38%3A%3A%3B0%3A55%3A%3A%3B0%3A33%3A%3A%3B0%3A174%3A%3A%3B0%3A123%3A%3A%3B0%3A49%3A%3A%3B0%3A62%3A%3A%3B0%3A12%3A%3A%3B0%3A46%3A%3A%3B0%3A144%3A%3A%3B0%3A115%3A%3A%3B0%3A133%3A%3A%3B0%3A24%3A%3A%3B0%3A85%3A%3A%3B0%3A72%3A%3A%3B0%3A127%3A%3A%3B0%3A143%3A%3A%3B0%3A134%3A%3A%3B0%3A106%3A%3A%3B0%3A5%3A%3A%3B0%3A6%3A%3A%3B0%3A173%3A%3A%3B0%3A4%3A%3A%3B0%3A30%3A%3A%3B0%3A15%3A%3A%3B0%3A126%3A%3A%3B0%3A50%3A%3A%3B0%3A9%3A%3A%3B0%3A177%3A%3A%3B0%3A176%3A%3A%3B0%3A41%3A%3A%3B0%3A128%3A%3A%3B0%3A131%3A%3A%3B0%3A3%3A%3A%3B0%3A8%3A%3A%3B0%3A116%3A%3A%3B0%3A86%3A%3A%3B0%3A164%3A%3A%3B0%3A122%3A%3A%3B0%3A165%3A%3A%3B0%3A160%3A%3A%3B0%3A162%3A%3A%3B0%3A39%3A%3A%3B0%3A172%3A%3A%3B0%3A31%3A%3A%3B0%3A51%3A%3A%3B0%3A179%3A%3A%3B0%3A2%3A%3A%3B0%3A152%3A%3A%3B0%3A157%3A%3A%3B0%3A141%3A%3A%3B0%3A7%3A%3A%3B0%3A108%3A%3A%3B0%3A142%3A%3A%3B0%3A121%3A%3A%3B0%3A25%3A%3A%3B0%3A69%3A%3A%3B0%3A138%3A%3A%3B0%3A117%3A%3A%3B0%3A161%3A%3A%3B0%3A171%3A%3A%3B0%3A43%3A%3A%3B0%3A18%3A%3A%3B0%3A158%3A%3A%3B0%3A59%3A%3A%3B0%3A83%3A%3A%3B0%3A118%3A%3A%3B0%3A147%3A%3A%3B0%3A125%3A%3A%3B0%3A89%3A%3A%3B0%3A17%3A%3A%3B0%3A107%3A%3A%3B0%3A53%3A%3A%3B0%3A153%3A%3A%3B0%3A28%3A%3A%3B0%3A44%3A%3A%3B0%3A27%3A%3A&selector%5Bexclude_sports_ids_str%5D=56+57+0+32+1+2+3+4+55+7+6+5+28+9+10+11+12+43+44+34+39+47+46+48+49+59+45+36+33+40+42+41+37+35+38+14+27+53+54+58+16+30+13+17+18+52+29+19+8+31+20+21+23+22+50+51+24+25+26&narrow='
        ],
        'unibet' => [
            'https://en.surebet.com/valuebets?utf8=%E2%9C%93&selector%5Bmin_group_size%5D=10&selector%5Bsettled_in%5D=21600&selector%5Bmin_odds%5D=1.6&selector%5Bmax_odds%5D=6.0&selector%5Bmin_overvalue%5D=&selector%5Bmax_overvalue%5D=&selector%5Bmin_probability%5D=&selector%5Bmax_probability%5D=&selector%5Bbookies_settings%5D=0%3A67%3A%3A%3B0%3A71%3A%3A%3B0%3A66%3A%3A%3B0%3A74%3A%3A%3B0%3A73%3A%3A%3B0%3A146%3A%3A%3B0%3A70%3A%3A%3B0%3A112%3A%3A%3B0%3A130%3A%3A%3B0%3A124%3A%3A%3B0%3A21%3A%3A%3B0%3A26%3A%3A%3B0%3A137%3A%3A%3B0%3A148%3A%3A%3B0%3A149%3A%3A%3B0%3A23%3A%3A%3B0%3A0%3A%3A%3B0%3A32%3A%3A%3B0%3A159%3A%3A%3B0%3A102%3A%3A%3B0%3A29%3A%3A%3B0%3A10%3A%3A%3B0%3A45%3A%3A%3B0%3A163%3A%3A%3B0%3A178%3A%3A%3B0%3A14%3A%3A%3B0%3A11%3A%3A%3B0%3A38%3A%3A%3B0%3A55%3A%3A%3B0%3A33%3A%3A%3B0%3A174%3A%3A%3B0%3A123%3A%3A%3B0%3A49%3A%3A%3B0%3A62%3A%3A%3B0%3A12%3A%3A%3B0%3A46%3A%3A%3B0%3A144%3A%3A%3B0%3A115%3A%3A%3B0%3A133%3A%3A%3B0%3A24%3A%3A%3B0%3A85%3A%3A%3B0%3A72%3A%3A%3B0%3A127%3A%3A%3B0%3A143%3A%3A%3B0%3A134%3A%3A%3B0%3A106%3A%3A%3B0%3A5%3A%3A%3B0%3A6%3A%3A%3B0%3A173%3A%3A%3B0%3A4%3A%3A%3B0%3A30%3A%3A%3B0%3A15%3A%3A%3B0%3A126%3A%3A%3B0%3A50%3A%3A%3B0%3A9%3A%3A%3B0%3A177%3A%3A%3B0%3A176%3A%3A%3B0%3A41%3A%3A%3B0%3A128%3A%3A%3B0%3A131%3A%3A%3B0%3A3%3A%3A%3B0%3A8%3A%3A%3B0%3A116%3A%3A%3B0%3A86%3A%3A%3B0%3A164%3A%3A%3B0%3A122%3A%3A%3B0%3A165%3A%3A%3B0%3A160%3A%3A%3B0%3A162%3A%3A%3B0%3A39%3A%3A%3B0%3A172%3A%3A%3B0%3A31%3A%3A%3B0%3A51%3A%3A%3B0%3A179%3A%3A%3B0%3A2%3A%3A%3B0%3A152%3A%3A%3B0%3A157%3A%3A%3B0%3A141%3A%3A%3B0%3A7%3A%3A%3B0%3A108%3A%3A%3B0%3A142%3A%3A%3B0%3A121%3A%3A%3B0%3A25%3A%3A%3B0%3A69%3A%3A%3B0%3A138%3A%3A%3B0%3A117%3A%3A%3B0%3A161%3A%3A%3B0%3A171%3A%3A%3B0%3A43%3A%3A%3B0%3A18%3A%3A%3B0%3A158%3A%3A%3B0%3A59%3A%3A%3B0%3A83%3A%3A%3B0%3A118%3A%3A%3B0%3A147%3A%3A%3B0%3A125%3A%3A%3B0%3A89%3A%3A%3B4%3A17%3A%3A%3B0%3A107%3A%3A%3B0%3A53%3A%3A%3B0%3A153%3A%3A%3B0%3A28%3A%3A%3B0%3A44%3A%3A%3B0%3A27%3A%3A&selector%5Bexclude_sports_ids_str%5D=56+57+0+32+1+2+3+55+7+6+5+28+9+10+11+12+43+44+47+46+48+49+59+45+33+40+42+41+37+38+14+27+53+54+58+16+30+13+17+18+52+29+19+8+31+20+21+23+50+51+24+25+26&narrow=',
        ],
        'williamhill' => [
            'https://en.surebet.com/valuebets?utf8=%E2%9C%93&selector%5Bmin_group_size%5D=10&selector%5Bsettled_in%5D=21600&selector%5Bmin_odds%5D=1.6&selector%5Bmax_odds%5D=6.0&selector%5Bmin_overvalue%5D=&selector%5Bmax_overvalue%5D=&selector%5Bmin_probability%5D=&selector%5Bmax_probability%5D=&selector%5Bbookies_settings%5D=0%3A67%3A%3A%3B0%3A71%3A%3A%3B0%3A66%3A%3A%3B0%3A74%3A%3A%3B0%3A73%3A%3A%3B0%3A146%3A%3A%3B0%3A70%3A%3A%3B0%3A112%3A%3A%3B0%3A130%3A%3A%3B0%3A124%3A%3A%3B0%3A21%3A%3A%3B0%3A26%3A%3A%3B0%3A137%3A%3A%3B0%3A148%3A%3A%3B0%3A149%3A%3A%3B0%3A23%3A%3A%3B0%3A0%3A%3A%3B0%3A32%3A%3A%3B0%3A159%3A%3A%3B0%3A102%3A%3A%3B0%3A29%3A%3A%3B0%3A10%3A%3A%3B0%3A45%3A%3A%3B0%3A163%3A%3A%3B0%3A178%3A%3A%3B0%3A14%3A%3A%3B0%3A11%3A%3A%3B0%3A38%3A%3A%3B0%3A55%3A%3A%3B0%3A33%3A%3A%3B0%3A174%3A%3A%3B0%3A123%3A%3A%3B0%3A49%3A%3A%3B0%3A62%3A%3A%3B0%3A12%3A%3A%3B0%3A46%3A%3A%3B0%3A144%3A%3A%3B0%3A115%3A%3A%3B0%3A133%3A%3A%3B0%3A24%3A%3A%3B0%3A85%3A%3A%3B0%3A72%3A%3A%3B0%3A127%3A%3A%3B0%3A143%3A%3A%3B0%3A134%3A%3A%3B0%3A106%3A%3A%3B0%3A5%3A%3A%3B0%3A6%3A%3A%3B0%3A173%3A%3A%3B0%3A4%3A%3A%3B0%3A30%3A%3A%3B0%3A15%3A%3A%3B0%3A126%3A%3A%3B0%3A50%3A%3A%3B0%3A9%3A%3A%3B0%3A177%3A%3A%3B0%3A176%3A%3A%3B0%3A41%3A%3A%3B0%3A128%3A%3A%3B0%3A131%3A%3A%3B0%3A3%3A%3A%3B0%3A8%3A%3A%3B0%3A116%3A%3A%3B0%3A86%3A%3A%3B0%3A164%3A%3A%3B0%3A122%3A%3A%3B0%3A165%3A%3A%3B0%3A160%3A%3A%3B0%3A162%3A%3A%3B0%3A39%3A%3A%3B0%3A172%3A%3A%3B0%3A31%3A%3A%3B0%3A51%3A%3A%3B0%3A179%3A%3A%3B0%3A2%3A%3A%3B0%3A152%3A%3A%3B0%3A157%3A%3A%3B0%3A141%3A%3A%3B0%3A7%3A%3A%3B0%3A108%3A%3A%3B0%3A142%3A%3A%3B0%3A121%3A%3A%3B0%3A25%3A%3A%3B0%3A69%3A%3A%3B0%3A138%3A%3A%3B0%3A117%3A%3A%3B0%3A161%3A%3A%3B0%3A171%3A%3A%3B0%3A43%3A%3A%3B0%3A18%3A%3A%3B0%3A158%3A%3A%3B0%3A59%3A%3A%3B0%3A83%3A%3A%3B0%3A118%3A%3A%3B0%3A147%3A%3A%3B0%3A125%3A%3A%3B0%3A89%3A%3A%3B0%3A17%3A%3A%3B0%3A107%3A%3A%3B0%3A53%3A%3A%3B0%3A153%3A%3A%3B4%3A28%3A%3A%3B0%3A44%3A%3A%3B0%3A27%3A%3A&selector%5Bexclude_sports_ids_str%5D=56+57+0+32+1+2+3+55+7+6+5+28+9+10+11+12+43+44+47+46+48+49+59+45+33+40+42+41+37+38+14+27+53+54+58+16+30+13+17+18+52+29+19+8+31+20+21+23+50+51+24+25+26&narrow=',
        ],
        'cloudbet' => [
            'https://en.surebet.com/valuebets?utf8=%E2%9C%93&selector%5Bmin_group_size%5D=10&selector%5Bsettled_in%5D=21600&selector%5Bmin_odds%5D=1.6&selector%5Bmax_odds%5D=6.0&selector%5Bmin_overvalue%5D=&selector%5Bmax_overvalue%5D=&selector%5Bmin_probability%5D=&selector%5Bmax_probability%5D=&selector%5Bbookies_settings%5D=0%3A67%3A%3A%3B0%3A71%3A%3A%3B0%3A66%3A%3A%3B0%3A74%3A%3A%3B0%3A73%3A%3A%3B0%3A146%3A%3A%3B0%3A70%3A%3A%3B0%3A112%3A%3A%3B0%3A130%3A%3A%3B0%3A124%3A%3A%3B0%3A21%3A%3A%3B0%3A23%3A%3A%3B0%3A26%3A%3A%3B0%3A137%3A%3A%3B0%3A148%3A%3A%3B0%3A149%3A%3A%3B0%3A123%3A%3A%3B0%3A%3A%3A%3B0%3A32%3A%3A%3B0%3A159%3A%3A%3B0%3A102%3A%3A%3B0%3A29%3A%3A%3B0%3A10%3A%3A%3B0%3A45%3A%3A%3B0%3A163%3A%3A%3B0%3A178%3A%3A%3B0%3A14%3A%3A%3B0%3A11%3A%3A%3B0%3A38%3A%3A%3B0%3A55%3A%3A%3B0%3A33%3A%3A%3B0%3A174%3A%3A%3B0%3A49%3A%3A%3B0%3A62%3A%3A%3B0%3A12%3A%3A%3B0%3A46%3A%3A%3B4%3A144%3A%3A%3B0%3A115%3A%3A%3B0%3A133%3A%3A%3B0%3A24%3A%3A%3B0%3A85%3A%3A%3B0%3A72%3A%3A%3B0%3A127%3A%3A%3B0%3A143%3A%3A%3B0%3A134%3A%3A%3B0%3A106%3A%3A%3B0%3A5%3A%3A%3B0%3A6%3A%3A%3B0%3A173%3A%3A%3B0%3A4%3A%3A%3B0%3A30%3A%3A%3B0%3A15%3A%3A%3B0%3A126%3A%3A%3B0%3A50%3A%3A%3B0%3A9%3A%3A%3B0%3A177%3A%3A%3B0%3A176%3A%3A%3B0%3A41%3A%3A%3B0%3A128%3A%3A%3B0%3A131%3A%3A%3B0%3A3%3A%3A%3B0%3A8%3A%3A%3B0%3A116%3A%3A%3B0%3A86%3A%3A%3B0%3A164%3A%3A%3B0%3A122%3A%3A%3B0%3A165%3A%3A%3B0%3A160%3A%3A%3B0%3A162%3A%3A%3B0%3A39%3A%3A%3B0%3A172%3A%3A%3B0%3A31%3A%3A%3B0%3A51%3A%3A%3B0%3A179%3A%3A%3B0%3A2%3A%3A%3B0%3A152%3A%3A%3B0%3A157%3A%3A%3B0%3A141%3A%3A%3B0%3A7%3A%3A%3B0%3A108%3A%3A%3B0%3A142%3A%3A%3B0%3A121%3A%3A%3B0%3A25%3A%3A%3B0%3A69%3A%3A%3B0%3A138%3A%3A%3B0%3A117%3A%3A%3B0%3A161%3A%3A%3B0%3A171%3A%3A%3B0%3A43%3A%3A%3B0%3A18%3A%3A%3B0%3A158%3A%3A%3B0%3A59%3A%3A%3B0%3A83%3A%3A%3B0%3A118%3A%3A%3B0%3A147%3A%3A%3B0%3A125%3A%3A%3B0%3A89%3A%3A%3B0%3A17%3A%3A%3B0%3A107%3A%3A%3B0%3A53%3A%3A%3B0%3A153%3A%3A%3B0%3A28%3A%3A%3B0%3A44%3A%3A%3B0%3A27%3A%3A&selector%5Bexclude_sports_ids_str%5D=56+57+0+43+32+1+2+3+55+7+6+5+28+8+44+9+26+10+11+12+47+46+48+49+59+14+27+53+54+58+16+30+13+17+18+52+29+45+19+33+31+40+42+41+20+50+51+21+37+23+24+38+25&narrow=',
        ],
    ];

    private array $userAgents = [];

    public function __construct()
    {
        $userAgents = Storage::disk('feed')->get('user-agents.json');
        $this->userAgents = json_decode($userAgents, true);
        $this->fetchAll();
    }

    public function fetchAll(): void
    {
        foreach ($this->bookiesAddr as $bookie => $addresses) {
            $bets = [
                'football' => [],
                'basketball' => [],
                'tennis' => [],
                'esport' => [],
            ];

            foreach ($addresses as $address) {
                $body = $this->fetch($address);
                $scrapedbets = $this->scrapeBets($body);
                $bets = array_merge_recursive($bets, $scrapedbets);
            }
            
            foreach ($bets as $sport => $value) {
                $value= json_encode($value);
                $path = $bookie . '/' . $sport . '/valuebets.json';
                Storage::disk('feed')->put($path, $value);
            }
        }
    }

    private function fetch(string $address) 
    {
        $randNumber = rand(0, count($this->userAgents) - 1);
        $userAgent = $this->userAgents[$randNumber];

        $response = Http::withOptions([
            'proxy' => 'http://jqhyiwog-rotate:evk36qb06ny5@p.webshare.io:80'
        ])->withHeaders([
            'User-Agent' => $userAgent,
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8',
            'Accept-Language' => 'en-US,en;q=0.5',
            'Accept-Encoding' => 'gzip',
            'Upgrade-Insecure-Requests' => '1',
            'Sec-Fetch-Dest' => 'document',
            'Sec-Fetch-Mode' => 'navigate',
            'Sec-Fetch-Site' => 'cross-site',
        ])->get($address);

        return $response->body();
    }

    //Function scrape bets from given html body and create 
    //JSON file for every sport, for specific bookie
    private function scrapeBets(string $body): array
    {
        $betsSortedBySports = [
            'football' => [],
            'basketball' => [],
            'tennis' => [],
            'esport' => [],
        ];

        $crawler = new Crawler($body);
        $trList = $crawler->filter('.app-table > tbody > tr');

        foreach($trList as $tr) {
            $bet = $tr->childNodes;
            $betArr = $this->getBet($bet);
            $sport = strtolower($betArr['sport']);
            array_push($betsSortedBySports[$sport], $betArr);
        }
        return $betsSortedBySports;
    }

    private function getBet(\DOMNodeList $bet): array
    {
        $bookieAndSport = $bet->item(0)->childNodes;
        $bookie = trim($bookieAndSport->item(0)->textContent);
        $sport = trim($bookieAndSport->item(3)->textContent);
        if (
            $sport == "Dota" ||
            $sport == "League of Legends" ||
            $sport == "Counter-Strike" ||
            $sport == "Valorant"
        ) {
            $sport = "Esport";
        }

        $dateTime = trim($bet->item(2)->textContent);
        $dateTime = $this->getDateTime($dateTime);
        $teamsAndLeague = $bet->item(4)->childNodes;
        $team = $teamsAndLeague->item(0)->textContent;
        $league = $teamsAndLeague->item(2)->textContent;
        if (str_contains($league, '] ')) {
            $league = explode('] ', $league)[1];
        }
        $betType = $bet->item(6)->textContent;
        $odd = floatval($bet->item(8)->textContent);
        $value = trim($bet->item(14)->textContent);
        $value = rtrim($value, "%");
        $value = ltrim($value, "+");
        $value = floatval($value);

        return [
            'bookie' => $bookie,
            'sport' => $sport,
            'date_time' => $dateTime,
            'team' => $team,
            'league' => $league,
            'bet' => $betType,
            'odd' => $odd,
            'value' => $value,
        ];
    }

    private function getDateTime(string $value): string
    {
        $day = substr($value, 0, 2);
        $month = substr($value, 3, 2);
        $time = substr($value, -5);
        $year = date('Y');
        $dateTime = $year . '-' . $month . '-' . $day . ' ' . $time;
        $date = Carbon::createFromFormat('Y-m-d H:i', $dateTime)->addHours(2);
        return (string)$date;
    }
}
