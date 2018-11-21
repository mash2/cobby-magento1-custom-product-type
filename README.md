# cobby-magento1-custom-product-type
extension for product type manipulation during import and export


#### product update json example:

```json
{
	"method":"call",
	"params":["{{sessionKey}}","cobby_import_product.importProducts",[[{
		"sku":"foo_bar001",
		"_attribute_set":"Shoes",
		"_type":"simple",
		"_store":"",
		"_id":"909",
		"name":"my virtual bar"
	}],["simple"],["foo_bar001"],"954d197716dc47c896cd10b6a38a0f43"]],"id":"id"
}
```

#### product import json example:

```json
{
	"method": "call",
	"params": ["{{sessionKey}}", "cobby_import_product.importProducts", [[{
				"sku":"foo_bar",
				"_attribute_set":"caps",
				"_type":"simple",
				"_store":"",
				"media_gallery":"inner",
				"name":"test",
				"description":"test",
				"short_description":"test",
				"news_from_date":"",
				"news_to_date":"","status":"1",
				"visibility":"4",
				"country_of_manufacture":"",
				"special_from_date":"",
				"special_to_date":"",
				"msrp_enabled":"2",
				"msrp_display_actual_price_type":"4",
				"tax_class_id":"2",
				"meta_title":"",
				"meta_keyword":"",
				"meta_description":"",
				"custom_design":"",
				"custom_design_from":"",
				"custom_design_to":"",
				"custom_layout_update":"",
				"page_layout":"",
				"options_container":"container2",
				"url_key":"",
				"manufacturer":"",
				"size":"",
				"gender":"",
				"occasion":"",
				"color":"",
				"gift_wrapping_price":"",
				"gift_wrapping_available":"",
				"gift_message_available":"",
				"msrp":"",
				"special_price":"",
				"price":"500",
				"weight":"0",
				"_product_websites":""
			},{
				"sku":"",
				"_attribute_set":null,
				"_type":null,
				"_store":null,
				"_product_websites":"base"
			}
		],[
			"simple"],["foo_bar",""], "sdokihfokishilf"]],
	"id": "id"
}
```
