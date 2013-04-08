WOOCOMMERCE_DIR=../woocommerce/
WOOCOMMERCE_VERSION=2.0.5

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
	--package-version=$(WOOCOMMERCE_VERSION) \
	--msgid-bugs-address="Remco Tolsma <info@remcotolsma.nl>" \
	--files-from=- \
	--output=$(CURDIR)/languages/woocommerce/woocommerce-admin.pot \

	cd $(WOOCOMMERCE_DIR) && \
	find . -iname "*.php" -type f -not -path "./admin/*" | xgettext \
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
	--package-version=$(WOOCOMMERCE_VERSION) \
	--msgid-bugs-address="Remco Tolsma &lt;info@remcotolsma.nl&gt;" \
	--files-from=- \
	--output=$(CURDIR)/languages/woocommerce/woocommerce.pot

	wget -O languages/woocommerce/nl_NL.po http://glotpress.pronamic.nl/projects/woocommerce/$(WOOCOMMERCE_VERSION)-formal/nl/nl_NL/export-translations

	msgfmt languages/woocommerce/nl_NL.po -o languages/woocommerce/nl_NL.mo

	wget -O languages/woocommerce/admin-nl_NL.po http://glotpress.pronamic.nl/projects/woocommerce/$(WOOCOMMERCE_VERSION)-formal/admin/nl/nl_NL/export-translations
	
	msgfmt languages/woocommerce/admin-nl_NL.po -o languages/woocommerce/admin-nl_NL.mo
