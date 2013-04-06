WOOCOMMERCE_DIR=../woocommerce/

# https://github.com/brotchie/keepnote/blob/master/Makefile.gettext

# Make message files
extract:
	cd $(WOOCOMMERCE_DIR) && \
	find ./admin -iname "*.php" -type f | xgettext \
	--from-code=UTF-8 \
	--keyword=__ \
	--keyword=_e \
	--keyword=_n:1,2 \
	--keyword=_x:1,2c \
	--keyword=_ex:1,2c \
	--keyword=_nx:1,2,4c \
	--default-domain=woocommerce \
	--language=PHP \
	--copyright-holder="Remco Tolsma" \
	--package-name=WooCommerce \
	--package-version=2.0.5 \
	--msgid-bugs-address="Remco Tolsma <info@remcotolsma.nl>" \
	--files-from=- \
	--output=$(CURDIR)/languages/woocommerce/woocommerce-admin.pot \

	cd $(WOOCOMMERCE_DIR) && \
	find ./ -iname "*.php" -type f | xgettext \
	--from-code=UTF-8 \
	--keyword=__ \
	--keyword=_e \
	--keyword=_n:1,2 \
	--keyword=_x:1,2c \
	--keyword=_ex:1,2c \
	--keyword=_nx:1,2,4c \
	--default-domain=woocommerce \
	--language=PHP \
	--copyright-holder="Remco Tolsma" \
	--package-name=WooCommerce \
	--package-version=2.0.5 \
	--msgid-bugs-address="Remco Tolsma &lt;info@remcotolsma.nl&gt;" \
	--files-from=- \
	--exclude-file=$(CURDIR)/languages/woocommerce/woocommerce-admin.pot \
	--output=$(CURDIR)/languages/woocommerce/woocommerce.pot
