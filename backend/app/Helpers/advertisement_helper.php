<?php

    function get_temads($template){

        $result = array();
        switch($template){
            case 'MV-1':
                $result = array(
                    'pos' => array(
                        array( 'name'=>'ด้านกลาง (ขนาดแนะนำ 820*260)', 'value'=>'1' ),
                        array( 'name'=>'ด้านซ้าย (ขนาดแนะนำ 180*500)', 'value'=>'2' ),
                        array( 'name'=>'ด้านขวา (ขนาดแนะนำ 180*500)', 'value'=>'3' ),
                        array( 'name'=>'ด้านล่าง (ขนาดแนะนำ 810*80)', 'value'=>'4' )
                    ),
                    'img' => array(
                        'img1' => '/assets/img/banners/MV-1/position-1.png',
                        'img2' => '/assets/img/banners/MV-1/position-2.png',
                        'img3' => '/assets/img/banners/MV-1/position-3.png',
                        'img4' => '/assets/img/banners/MV-1/position-4.png',
                    )
                );
                break;
            
            case 'MV-2':
                $result = array(
                    'pos' => array(
                        array( 'name'=>'ด้านกลาง (ขนาดแนะนำ 820*260)', 'value'=>'1' ),
                        array( 'name'=>'ด้านซ้าย (ขนาดแนะนำ 180*500)', 'value'=>'2' ),
                        array( 'name'=>'ด้านขวา (ขนาดแนะนำ 180*500)', 'value'=>'3' ),
                        array( 'name'=>'ด้านล่าง (ขนาดแนะนำ 810*80)', 'value'=>'4' )
                    ),
                    'img' => array(
                        'img1' => '/assets/img/banners/MV-2/position-1.png',
                        'img2' => '/assets/img/banners/MV-2/position-2.png',
                        'img3' => '/assets/img/banners/MV-2/position-3.png',
                        'img4' => '/assets/img/banners/MV-2/position-4.png',
                    )
                );
                break;
                
            case 'MV-3':
                $result = array(
                    'pos' => array(
                        array( 'name'=>'ด้านบน (ขนาดแนะนำ)', 'value'=>'1' ),
                        array( 'name'=>'ด้านล่าง (ขนาดแนะนำ)', 'value'=>'2' ),
                        array( 'name'=>'ด้านซ้าย (ขนาดแนะนำ)', 'value'=>'3' )
                    ),
                    'img' => array(
                        'img1' => '/assets/img/banners/MV-3/position-1.png',
                        'img2' => '/assets/img/banners/MV-3/position-2.png',
                        'img3' => '/assets/img/banners/MV-3/position-3.png',
                    )
                );
                break;
                    
            case 'MV-4':
                $result = array(
                    'pos' => array(
                        array( 'name'=>'ด้านบน (ขนาดแนะนำ 1200 * 120)', 'value'=>'1' ),
                        array( 'name'=>'ด้านล่าง (ขนาดแนะนำ 1200 * 100)', 'value'=>'2' ),
                        array( 'name'=>'ด้านซ้าย (ขนาดแนะนำ 300 * 300)', 'value'=>'3' )
                    ),
                    'img' => array(
                        'img1' => '/assets/img/banners/MV-4/position-1.jpg',
                        'img2' => '/assets/img/banners/MV-4/position-2.jpg',
                        'img3' => '/assets/img/banners/MV-4/position-3.jpg',
                    )
                );
                break;
            
            case 'MV-5':
                $result = array(
                    'pos' => array(
                        array( 'name'=>'ด้านบน (ขนาดแนะนำ 1200 * 120)', 'value'=>'1' ),
                        array( 'name'=>'ด้านล่าง (ขนาดแนะนำ 1200 * 100)', 'value'=>'2' ),
                        array( 'name'=>'ด้านซ้าย (ขนาดแนะนำ 300 * 300)', 'value'=>'3' )
                    ),
                    'img' => array(
                        'img1' => '/assets/img/banners/MV-5/position-1.jpg',
                        'img2' => '/assets/img/banners/MV-5/position-2.jpg',
                        'img3' => '/assets/img/banners/MV-5/position-3.jpg',
                    )
                );
                break;

            case 'MV-6':
                $result = array(
                    'pos' => array(
                        array( 'name'=>'ด้านบน (ขนาดแนะนำ 600 * 140)', 'value'=>'1' ),
                        array( 'name'=>'ด้านซ้าย (ขนาดแนะนำ 300 * 300)', 'value'=>'2' ),
                        array( 'name'=>'ด้านล่าง (ขนาดแนะนำ 728 * 94)', 'value'=>'3' )
                    ),
                    'img' => array(
                        'img1' => '/assets/img/banners/MV-6/position-1.jpg',
                        'img2' => '/assets/img/banners/MV-6/position-2.jpg',
                        'img3' => '/assets/img/banners/MV-6/position-3.jpg',
                    )
                );
                break;
            
            case 'MG-1':
                $result = array(
                    'pos' => array(
                        array( 'name'=>'ด้านบน (ขนาดแนะนำ 600 * 140)', 'value'=>'1' ),
                        array( 'name'=>'ด้านซ้าย (ขนาดแนะนำ 200 * 400)', 'value'=>'2' ),
                        array( 'name'=>'ด้านล่าง (ขนาดแนะนำ 728 * 94)', 'value'=>'3' )
                    ),
                    'img' => array(
                        'img1' => '/assets/img/banners/MG-2/position-1.jpg',
                        'img2' => '/assets/img/banners/MG-2/position-2.jpg',
                        'img3' => '/assets/img/banners/MG-2/position-3.jpg',
                    )
                );
                break;

            case 'MG-2':
                $result = array(
                    'pos' => array(
                        array( 'name'=>'ด้านซ้าย (ขนาดแนะนำ 200 * 400)', 'value'=>'1' ),
                        array( 'name'=>'ด้านกลาง (ขนาดแนะนำ 600 * 140)', 'value'=>'2' ),
                        array( 'name'=>'ด้านขวา (ขนาดแนะนำ 200 * 400)', 'value'=>'3' ),
                        array( 'name'=>'ด้านล่าง (ขนาดแนะนำ 728 * 94)', 'value'=>'4' )
                    ),
                    'img' => array(
                        'img1' => '/assets/img/banners/MG-1/position-1.jpg',
                        'img2' => '/assets/img/banners/MG-1/position-2.jpg',
                        'img3' => '/assets/img/banners/MG-1/position-3.jpg',
                        'img4' => '/assets/img/banners/MG-1/position-4.jpg'
                    )
                );
                break;
                            
            case 'MG-3':
                $result = array(
                    'pos' => array(
                        array( 'name'=>'ด้านซ้าย (ขนาดแนะนำ)', 'value'=>'1' ),
                        array( 'name'=>'ด้านบน (ขนาดแนะนำ)', 'value'=>'2' ),
                        array( 'name'=>'ด้านขวา (ขนาดแนะนำ)', 'value'=>'3' ),
                        array( 'name'=>'ด้านล่าง (ขนาดแนะนำ)', 'value'=>'4' )
                    ),
                    'img' => array(
                        'img1' => '/assets/img/banners/MG-3/position-1.png',
                        'img2' => '/assets/img/banners/MG-3/position-2.png',
                        'img3' => '/assets/img/banners/MG-3/position-3.png',
                    )
                );
                break;
        }

        return $result;
    }

?>
