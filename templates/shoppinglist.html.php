<link rel="stylesheet" href="/css/shoppinglist.css">
<div class="jumbotron fill-height">
    <div class="container fill-height">
        <h1 class="display-3">Shopping List</h1>
        <!-- if not logged in display the below: -->
        <!-- <p>
      This app allows you to upload your photos and view them in a slide show.
    </p> -->
        <?php if (!$loggedIn): ?>
        <span class="alert alert-warning" role="alert">You must be logged in to be able to use this app.</span>
        <?php endif;?>
    </div>
</div>

<div class="container">
    <?php if ($loggedIn): ?>
    <form action="" method="post">
        <div class="row">
            <div class="col-md-12 mb-3">
                <button id="btnNewCategory" type="button" class="btn btn-link btn-new-item text-success">
                    <svg class="icon icon-add-solid">
                        <use xlink:href="#icon-add-solid"></use>
                    </svg> <span class="btn-txt">Add a new shopping category</span></button>
                <button id="btnNewCategoryBack" type="button" class="btn btn-link btn-new-item text-danger" style="display:none!important">
                    <!-- <span class="btn-symbol"> -->
                    <svg class="icon icon-undo21">
                        <use xlink:href="#icon-undo21"></use>
                    </svg>
                    <span class="btn-txt">Nevermind</span>
                </button>
                <input type="text" id="newCategory" name="newcategory" text="" class="form-control new-category no-display" placeholder="Fancy New Category Name (e.g. Clothes)" />
                <input type="submit" id="btnSaveNewCategory" value="Save" class="btn btn-success no-display" />
                <div class="invalid-feedback">
                    Please insert a new category
                </div><!-- /invalid-feedback -->
            </div><!-- /col-md-4 mb-3 -->
        </div><!-- /row -->
        <div class="row">
            <div class="col-md-12 mb-3">
                <ul class="shopping-categories">
                    <?php $value = 1;?>
                    <?php foreach ($shoppingCategories as $category): ?>
                    <li value="<?=$value?>" data-id="<?=$category["id"]?>">
                        <h2>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="shopcategory[<?=$category["id"]?>]" id="shopcategory<?=$category["id"]?>" value="false" class="custom-control-input" />
                                <label class="custom-control-label" for="shopcategory<?=$category["id"]?>"><?=$category["category"]?></label>
                                <input type="submit" id="confirmDelete<?=$value?>" value="Confirm" class="btn btn-danger no-display" />
                                <button id="btnNewItem<?=$category["id"]?>" data-catid="<?=$category["id"]?>" class="btn btn-link btn-new-item btn-symbol text-success">
                                    <span class="new-item btn-txt"><svg class="icon icon-add-solid">
                                            <use xlink:href="#icon-add-solid"></use>
                                        </svg></span>
                                    <span class="new-item btn-txt"> Add a new <span id="addNewCatTxt<?=$value?>"><?=$category["category"]?></span> item</span></button>
                                <button id="btnNewItemBack<?=$category["id"]?>" data-catid="<?=$category["id"]?>" type="button" class="btn btn-link btn-new-item text-danger d-block" style="display:none!important">
                                    <!-- <span class="btn-symbol"> -->
                                    <span class="new-item btn-txt"><svg class="icon icon-undo21">
                                            <use xlink:href="#icon-undo21"></use>
                                        </svg></span>
                                    <span class="new-item btn-txt">Nevermind </span>
                                </button>
                            </div>
                        </h2> <input type="hidden" name="itemcategoryid[]" value="" />
                        <input type="text" id="newItem<?=$category["id"]?>" name="newitem[]" data-categoryid="<?=$category["id"]?>" text="" class="form-control new-category no-display" placeholder="Fancy New Item Name (e.g. dish detergent)" />
                        <input type="submit" id="btnSaveNewItem<?=$category["id"]?>" value="Save" class="btn btn-success no-display" />
                        <div class="invalid-feedback">
                            Please insert a new item
                        </div><!-- /invalid-feedback -->
                        <ul class="shopping-items">
                            <?php $itemIndex = 1;?>
                            <?php foreach ($shoppingItems as $item): ?>
                            <?php if ($item["category_id"] == $category["id"]): ?>
                            <li>
                                <input type="hidden" name="hiddenInputshopitem[<?=$item["id"]?>]" value="" />
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="shopitem<?=$item["id"]?>" name="shopitem[<?=$item["item_name"]?>]" data-id="<?=$item["id"]?>" class="custom-control-input shop-item" value="false" />
                                    <label class="custom-control-label" for="shopitem<?=$item["id"]?>"><?=$item["item_name"]?></label>
                                    <input type="submit" id="confirmDeleteItem<?=$itemIndex?>" value="Confirm" class="btn btn-danger no-display" />
                                </div>
                            </li>
                            <?php $itemIndex = $itemIndex + 1;?>
                            <?php endif;?>
                            <?php endforeach;?>
                        </ul>
                    </li>
                    <?php $value = $value + 1;?>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
    </form>
</div> <!-- /container -->

<?php endif;?>

<script type="text/javascript" src="/js/shoppinglist.js"></script>