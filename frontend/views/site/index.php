<?php

/** @var yii\web\View $this */

$this->title = 'CRM';
?>
<div class="site-index">
    <div class="row">
        <div class="col-6">
            <form id="application">
                <h1> Создать заявку </h1>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" />
                    <div id="name_error" class="form-text text-danger"></div>
                </div>
                <div class="form-group">
                    <label for="customer_name">Customer</label>
                    <input type="text" class="form-control" name="customer_name" />
                    <div id="customer_name_error" class="form-text text-danger"></div>
                </div>
                <div class="form-group">
                    <label for="product_id">Product</label>
                    <select name="product_id" class="form-select"></select>
                    <div id="product_id_error" class="form-text text-danger"></div>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" name="price" />
                    <div id="price_error" class="form-text text-danger"></div>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" name="phone" />
                    <div id="phone_error" class="form-text text-danger"></div>
                </div>
                <div class="form-group">
                    <label for="comment">Comment</label>
                    <textarea class="form-control" name="comment" rows="5"></textarea>
                    <div id="comment" class="form-text text-danger"></div>
                </div>
                <button id="create" type="button" class="btn btn-primary" onclick="createRequest()">Create</button>
            </form>
        </div>
        <div id="app_alert" class="alert alert-primary" role="alert" style="display: none">
            Application <strong id="app_num"></strong> was created successfully!
        </div>
    </div>
</div>
