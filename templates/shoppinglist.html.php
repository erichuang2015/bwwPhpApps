<link rel="stylesheet" href="/css/shoppinglist.css">
<input id="language" type="hidden" value="<?= $language?>">
<input id="hiddenCategoryInputError" type="hidden" value="<?= $content['hiddenCategoryInputError'] ?>">
<input id="itemInputError" type="hidden" value="<?= $content['itemInputError'] ?>">
<div class="jumbotron fill-height">
    <div class="container fill-height">
        <h1 class="display-3"><?= $content['h1Text'] ?></h1>
        <!-- if not logged in display the below: -->
        <!-- <p>
      This app allows you to upload your photos and view them in a slide show.
    </p> -->
        <?php if (!$loggedIn): ?>
        <span class="alert alert-warning" role="alert"><?= $content['errorMustBeLoggedIn'] ?></span>
        <?php endif;?>
    </div>
</div>

<div class="container">
    <?php if ($loggedIn): ?>
    <form action="" method="post" class="needs-validation" autocomplete="off" novalidate>
        <div class="row">
            <div class="col-md-12 mb-3">
                <button id="btnNewCategory" type="button" class="btn btn-link btn-new-item text-success" data-disabled="false">
                    <svg class="icon icon-add-solid">
                        <use xlink:href="#icon-add-solid"></use>
                    </svg> <span class="btn-txt"><?= $content['toolTipAddCategory'] ?></span></button>
                <button id="btnNewCategoryBack" type="button" class="btn btn-link btn-new-item text-danger" style="display:none!important">
                    <!-- <span class="btn-symbol"> -->
                    <svg class="icon icon-undo21">
                        <use xlink:href="#icon-undo21"></use>
                    </svg>
                    <span class="btn-txt"><?= $content['btnTxtNevermind'] ?></span>
                </button>
                <input type="text" id="newCategory" name="newcategory" class="form-control new-category no-display" placeholder="<?= $content['placeholderNewCategory'] ?>" />
                <input type="submit" id="btnSaveNewCategory" value="<?= $content['btnSave'] ?>" class="btn btn-success no-display" />
                <div class="invalid-feedback">
                    <span id="categoryInputError"></span>
                </div><!-- /invalid-feedback -->
            </div><!-- /col-md-4 mb-3 -->
        </div><!-- /row -->
        <div class="row">
            <div class="col-md-12 mb-3">
                <ul class="shopping-categories">
                    <?php $value = 1;?>
                    <?php foreach ($shoppingCategories as $category): ?>
                    <li id="categoryli<?=$category["id"]?>" value="<?=$value?>" data-id="<?=$category["id"]?>">
                        <h2>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="shopcategory[<?=$category["id"]?>]" id="shopcategory<?=$category["id"]?>" value="false" class="custom-control-input checkbox-category" />
                                <label class="custom-control-label" for="shopcategory<?=$category["id"]?>"><?=$category["category"]?></label>
                                <input type="submit" id="confirmDelete<?=$value?>" value="<?= $content['btnConfirm'] ?>" class="btn btn-danger no-display" />
                                <button id="btnNewItem<?=$category["id"]?>" data-catid="<?=$category["id"]?>" class="btn btn-link btn-new-item btn-symbol text-success" data-disabled="false">
                                    <span class="new-item btn-txt"><svg class="icon icon-add-solid">
                                            <use xlink:href="#icon-add-solid"></use>
                                        </svg></span>
                                    <span class="new-item btn-txt"><?= $content['addNew'] ?><span id="addNewCatTxt<?=$value?>"><?=$category["category"]?></span><?= $content['item'] ?></span></button>
                                <button id="btnNewItemBack<?=$category["id"]?>" data-catid="<?=$category["id"]?>" type="button" class="btn btn-link btn-new-item text-danger d-block" style="display:none!important">
                                    <!-- <span class="btn-symbol"> -->
                                    <span class="new-item btn-txt"><svg class="icon icon-undo21">
                                            <use xlink:href="#icon-undo21"></use>
                                        </svg></span>
                                    <span class="new-item btn-txt"><?= $content['nevermind'] ?></span>
                                </button>
                            </div>
                        </h2> <input type="hidden" name="itemcategoryid[]" value="" />
                        <input type="text" id="newItem<?=$category["id"]?>" name="newitem[]" data-categoryid="<?=$category["id"]?>" text="" class="form-control new-item no-display" placeholder="<?= $content['newItemPlaceHolder'] ?>" />
                        <input type="submit" id="btnSaveNewItem<?=$category["id"]?>" value="<?= $content['btnSave'] ?>" class="btn btn-success no-display" />
                        <div class="invalid-feedback">
                            <span id="itemInputError"></span>
                        </div><!-- /invalid-feedback -->
                        <ul id="shoppingItemsList<?=$category["id"]?>" class="shopping-items" data-categoryid="<?=$category["id"]?>">
                            <?php $itemIndex = 1;?>
                            <?php foreach ($shoppingItems as $item): ?>
                            <?php if ($item["category_id"] == $category["id"]): ?>
                            <li>
                                <div class="custom-control custom-checkbox">
                                    <input type="hidden" name="hiddenInputshopitem[<?=$item['id']?>]" value="" />
                                    <input type="checkbox" id="shopitem<?=$item["id"]?>" name="shopitem[<?=$item["item_name"]?>]" data-id="<?=$item["id"]?>" class="custom-control-input shop-item" value="false" />
                                    <label class="custom-control-label" for="shopitem<?=$item["id"]?>"><?=$item["item_name"]?></label>
                                    <input type="submit" id="confirmDeleteItem<?=$itemIndex?>" value="<?= $content['btnConfirm'] ?>" class="btn btn-danger no-display" />
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