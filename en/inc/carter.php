<?php

$json = $zp->JsonBuilder()->get(products);
$products = json_decode($json);

// Shopping Cart Page
	$cartContents = '
	<div class="alert alert-warning">
		<i class="fa fa-info-circle"></i> There are no items in the cart.
	</div>';

	// Empty the cart
	if (isset($_POST['empty'])) {
		$cart->clear();
	}

	// Add item
	if (isset($_POST['add'])) {
		foreach ($products as $product) {
			if ($_POST['id'] == $product->p_id) {
				break;
			}
		}

		$cart->add($product->p_id, $_POST['qty'], [
			'price' => $product->p_current_price,
		]);
	}

	// Update item
	if (isset($_POST['update'])) {
		foreach ($products as $product) {
			if ($_POST['id'] == $product->p_id) {
				break;
			}
		}

		$cart->update($product->p_id, $_POST['qty'], [
			'price' => $product->p_current_price,
		]);
	}

	// Remove item
	if (isset($_POST['remove'])) {
		foreach ($products as $product) {
			if ($_POST['id'] == $product->p_id) {
				break;
			}
		}

		$cart->remove($product->p_id, [
			'price' => $product->p_current_price,
		]);
	}