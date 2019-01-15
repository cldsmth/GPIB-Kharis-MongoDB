<?php $linkToPage = linkToPage($_page, $_SERVER['QUERY_STRING']);?>
<div class="dataTables_paginate paging_simple_numbers" id="default-datatable_paginate">
  <ul class="pagination">
    <?php if($_page > 1){?>
    <li id="default-datatable_previous" class="paginate_button previous">
      <a href="<?=$path[$curpage]."?page=".($_page-1).$linkToPage;?>" aria-controls="default-datatable" data-dt-idx="0" tabindex="0"><i class="fa fa-chevron-left"></i> Previous</a>
    </li>
    <?php }?>

    <?php if($_page > 3){?>
    <li class="paginate_button">
      <a href="<?=$path[$curpage]."?page=1".$linkToPage;?>" aria-controls="default-datatable" data-dt-idx="1" tabindex="0">1</a>
    </li>
    <li class="paginate_button">
      <a href="javascript:void(0)" aria-controls="default-datatable" data-dt-idx="0" tabindex="0">...</a>
    </li>
    <?php }?>

    <?php if($_page-2 > 0){?>
    <li class="paginate_button">
      <a href="<?=$path[$curpage]."?page=".($_page-2).$linkToPage;?>" aria-controls="default-datatable" data-dt-idx="<?=($_page-2);?>" tabindex="0"><?=($_page-2);?></a>
    </li>
    <?php }?>

    <?php if($_page-1 > 0){?>
    <li class="paginate_button">
      <a href="<?=$path[$curpage]."?page=".($_page-1).$linkToPage;?>" aria-controls="default-datatable" data-dt-idx="<?=($_page-1);?>" tabindex="0"><?=($_page-1);?></a>
    </li>
    <?php }?>

    <li class="paginate_button active">
      <a href="<?=$path[$curpage]."?page=".$_page.$linkToPage;?>" aria-controls="default-datatable" data-dt-idx="<?=$_page;?>" tabindex="0"><?=$_page;?></a>
    </li>

    <?php if(($total_page > 1 && $_page != $total_page) && ($_page+1 < ceil($total_data_all / $total_data)+1)){?>
    <li class="paginate_button">
      <a href="<?=$path[$curpage]."?page=".($_page+1).$linkToPage;?>" aria-controls="default-datatable" data-dt-idx="<?=($_page+1);?>" tabindex="0"><?=($_page+1);?></a>
    </li>
    <?php }?>

    <?php if(($total_page > 1 && $_page != $total_page) && ($_page+2 < ceil($total_data_all / $total_data)+1)){?>
    <li class="paginate_button">
      <a href="<?=$path[$curpage]."?page=".($_page+2).$linkToPage;?>" aria-controls="default-datatable" data-dt-idx="<?=($_page+2);?>" tabindex="0"><?=($_page+2);?></a>
    </li>
    <?php }?>

    <?php if(($total_page > 1 && $_page != $total_page) && ($_page < ceil($total_data_all / $total_data)-2)){?>
    <li class="paginate_button">
      <a href="javascript:void(0)" aria-controls="default-datatable" data-dt-idx="0" tabindex="0">...</a>
    </li>
    <li class="paginate_button">
      <a href="<?=$path[$curpage]."?page=".ceil($total_data_all / $total_data).$linkToPage;?>" aria-controls="default-datatable" data-dt-idx="<?=ceil($total_data_all / $total_data);?>" tabindex="0"><?=ceil($total_data_all / $total_data);?></a>
    </li>
    <?php }?>

    <?php if(($total_page > 1 && $_page != $total_page) && ($_page < ceil($total_data_all / $total_data))){?>
    <li id="default-datatable_next" class="paginate_button next">
      <a href="<?=$path[$curpage]."?page=".($_page+1).$linkToPage;?>" aria-controls="default-datatable" data-dt-idx="<?=($_page+1);?>" tabindex="0"><i class="fa fa-chevron-right"></i> Next</a>
    </li>
    <?php }?>
  </ul>
</div>