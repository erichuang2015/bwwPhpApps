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
                <button id="btnNewCategory" type="button" class="btn btn-link btn-new-item text-success"><span class="btn-symbol">+</span> <span class="btn-txt">Add a new shopping category</span></button>
                <button id="btnNewCategoryBack" type="button" class="btn btn-link btn-new-item text-danger" style="display:none!important"><span class="btn-symbol"><span class="btn-symbol text-danger">
                            <- </span> <span class="btn-txt">Nevermind
                        </span></button>
                <input type="text" id="newCategory" name="newcategory" text="" class="form-control new-category no-display" placeholder="Fancy New Category Name (e.g. Clothes)" />
                <div class="invalid-feedback">
                    Please insert a new category
                </div><!-- /invalid-feedback -->
                <!-- <input id="submit" name="submit" type="submit" class="btn btn-primary btn-lg"
                        style="display:none!important" disabled /> -->
            </div><!-- /col-md-4 mb-3 -->
        </div><!-- /row -->
        <div class="row">
            <div class="col-md-12 mb-3">
                <ul class="shopping-categories">
                    <?php $value = 1;?>
                    <?php foreach ($shoppingCategories as $category): ?>
                    <li value="<?=$value?>" data-id="<?=$category["id"]?>">
                        <h2><input type="checkbox" name="shopcategory[<?=$category["id"]?>]" value="false" /><?=$category["category"]?><input type="submit" id="confirmDelete<?=$value?>" value="confirm" class="no-display" />

                            <button id="btnNewItem<?=$category["id"]?>" data-catid="<?=$category["id"]?>" class="btn btn-link btn-new-item btn-symbol text-success">+</button>
                            <button id="btnNewItemBack<?=$category["id"]?>" data-catid="<?=$category["id"]?>" type="button" class="btn btn-link btn-new-item text-danger" style="display:none!important"><span class="btn-symbol"><span class="btn-symbol">
                                        <- </span> </button> </h2> <input type="hidden" name="itemcategoryid[]" value="" />
                                        <input type="text" id="newItem<?=$category["id"]?>" name="newitem[]" data-categoryid="<?=$category["id"]?>" text="" class="form-control new-category no-display" placeholder="Fancy New Item Name (e.g. dish detergent)" />
                                        <div class="invalid-feedback">
                                            Please insert a new item
                                        </div><!-- /invalid-feedback -->
                                        <ul>
                                            <?php $itemIndex = 1;?>
                                            <?php foreach ($shoppingItems as $item): ?>
                                            <?php if ($item["category_id"] == $category["id"]): ?>
                                            <li>
                                                <input type="hidden" name="hiddenInputshopitem[<?=$item["id"]?>]" value="" />
                                                <input type="checkbox" name="shopitem[<?=$item["item_name"]?>]" data-id="<?=$item["id"]?>" class="shop-item" value="false" />
                                                <?=$item["item_name"]?>
                                                <input type="submit" id="confirmDeleteItem<?=$itemIndex?>" value="confirm" class="no-display" />
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

<hr>

<div class="album py-5 bg-light">
    <div class="container">
        <div class="row">

        </div><!-- /row -->
    </div><!-- /container -->
</div><!-- /album py-5 bg-light -->

<?php endif;?>

<script type="text/javascript" src="/js/shoppinglist.js"></script>