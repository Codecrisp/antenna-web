@extends('layouts.dashboard')

@section('content')
	<div class="row">
	  <div class="col-md-12">
		<div class="invoice">
		  <div class="row invoice-header">
			<div class="col-xs-7">
			  <div class="invoice-logo"></div>
			</div>
			<div class="col-xs-5 invoice-order"><span class="invoice-id">Invoice #2308</span><span class="incoice-date">August 23, 2016</span></div>
		  </div>
		  <div class="row invoice-data">
			<div class="col-xs-5 invoice-person"><span class="name">Kristopher Donny</span><span>Developer and Designer</span><span>donny@designer.co</span><span>661 Bubby Street</span><span>United States</span></div>
			<div class="col-xs-2 invoice-payment-direction"><i class="icon mdi mdi-chevron-right"></i></div>
			<div class="col-xs-5 invoice-person"><span class="name">Elliot Mark</span><span>CEO at BLX</span><span>ceoblx@company.co</span><span>839 Owagner Drive</span><span>United States</span></div>
		  </div>
		  <div class="row">
			<div class="col-md-12">
			  <table class="invoice-details">
				<tr>
				  <th style="width:60%">Description</th>
				  <th style="width:17%" class="hours">Hours</th>
				  <th style="width:15%" class="amount">Amount</th>
				</tr>
				<tr>
				  <td class="description">Web design (Etiam sagittis metus sit amet mauris gravida hendrerit)</td>
				  <td class="hours">60</td>
				  <td class="amount">$4,200.00</td>
				</tr>
				<tr>
				  <td class="description">Responsive design (Etiam sagittis metus sit amet mauris gravida hendrerit)</td>
				  <td class="hours">10</td>
				  <td class="amount">$1,500.00</td>
				</tr>
				<tr>
				  <td class="description">Logo design (Cras faucibus tincidunt elit id rhoncus.)</td>
				  <td class="hours">12</td>
				  <td class="amount">$1,700.00</td>
				</tr>
				<tr>
				  <td></td>
				  <td class="summary">Subtotal</td>
				  <td class="amount">$7,400,00</td>
				</tr>
				<tr>
				  <td></td>
				  <td class="summary">Discount (20%)</td>
				  <td class="amount">$1,480,00</td>
				</tr>
				<tr>
				  <td></td>
				  <td class="summary total">Total</td>
				  <td class="amount total-value">$5,920</td>
				</tr>
			  </table>
			</div>
		  </div>
		  <div class="row">
			<div class="col-md-12 invoice-payment-method"><span class="title">Payment Method</span><span>Credit card</span><span>Credit card type: mastercard</span><span>Number verification: 4256981387</span></div>
		  </div>
		  <div class="row">
			<div class="col-md-12 invoice-message"><span class="title">Thank you for contacting us</span>
			  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas quis massa nisl. Sed fringilla turpis id mi ultrices, et faucibus ipsum aliquam. Sed ut eros placerat, facilisis est eu, congue felis.</p>
			</div>
		  </div>
		  <div class="row invoice-company-info">
			<div class="col-sm-6 col-md-2 logo"><img src="assets/img/logo-symbol.png" alt="Logo-symbol"></div>
			<div class="col-sm-6 col-md-4 summary"><span class="title">Beagle Company</span>
			  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
			</div>
			<div class="col-sm-6 col-md-3 phone">
			  <ul class="list-unstyled">
				<li>+1(535)-8999278</li>
				<li>+1(656)-3558302</li>
			  </ul>
			</div>
			<div class="col-sm-6 col-md-3 email">
			  <ul class="list-unstyled">
				<li>beagle@company.co</li>
				<li>beagle@support.co</li>
			  </ul>
			</div>
		  </div>
		  <div class="row invoice-footer">
			<div class="col-md-12">
			  <button class="btn btn-lg btn-space btn-default">Save PDF</button>
			  <button class="btn btn-lg btn-space btn-primary">Pay now</button>
			</div>
		  </div>
		</div>
	  </div>
	</div>

@endsection
