<?php
$menu_name = 'header-menu';
$locations = get_nav_menu_locations();
$menu = wp_get_nav_menu_object( $menu_name );
$menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );
$submenu1 = array();
$menu1 = array();
$submenu2 = array();
foreach ($menuitems as $key => $value1) {
    if($value1->menu_item_parent==0){
        $menu1[] = $value1;
    }else{
        $submenu1[$value1->menu_item_parent][] = $value1;
        $submenu2[$value1->menu_item_parent][] = $value1->url;
    }
}
?>
<nav>
    <ul>
    <?php
    foreach($menu1 as $row1){
        if(count($submenu1[$row1->ID])>0){
            if(in_array($currebt_url, $submenu2[$row1->ID])){ $act1='active'; }else{ $act1=''; }
            ?>
            <li>
                <a href="javascript:void(0)" title="" class="<?= $act1; ?>"><?= $row1->title ?></a>
                <div class="submenu">    
                    <ul>
                        <?php foreach($submenu1[$row1->ID] as $row2){ ?>
                            <?php
                            if($currebt_url==$row2->url){ $act2='active'; }else{ $act2=''; }
                            ?>
                            <li class="<?= $act2; ?>"><a href="<?= $row2->url; ?>"><i class="material-icons">brightness_low</i> <?= $row2->title ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </li>
            <?php
        } else {
            if($currebt_url==$row1->url){ $act3='active'; }else{ $act3=''; }
            ?><li><a href="<?= $row1->url; ?>" title="" class="<?= $act3; ?>"><?= $row1->title ?></a></li><?php
        }
    } ?>
    </ul>
</nav>
