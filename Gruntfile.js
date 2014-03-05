module.exports = function( grunt ) {
	// Project configuration.
	grunt.initConfig( {
		// Package
		pkg: grunt.file.readJSON( 'package.json' ),
		
		// WooCommerce
		wooCommerceVersion: '2.1.3',
		
		// PHPLint
		phplint: {
			options: {
				phpArgs: {
					'-lf': null
				}
			},
			all: [ '**/*.php' ]
		},
		
		// Check WordPress version
		checkwpversion: {
			options: {
				readme: 'readme.txt',
				plugin: 'woocommerce-nl.php',
			},
			check: {
				version1: 'plugin',
				version2: 'readme',
				compare: '=='
			},
			check2: {
				version1: 'plugin',
				version2: '<%= pkg.version %>',
				compare: '=='
			}
		},
		
		// Make POT
		makepot: {
			target: {
				options: {
					cwd: '',
					domainPath: 'languages',
					type: 'wp-plugin'
				}
			}
		},
		
		// Shell
		shell: {
			downloadPo: {
				command: [
					'GLOTPRESS_URL=http://glotpress.pronamic.nl/projects/woocommerce/<%= wooCommerceVersion %>/nl/nl_NL/export-translations',
					'PO_FILE=languages/woocommerce/nl_NL.po',
					'touch $PO_FILE',
					'wget -O $PO_FILE $GLOTPRESS_URL'
				].join( '&&' )
	        },
			downloadAdminPo: {
				command: [
					'GLOTPRESS_URL=http://glotpress.pronamic.nl/projects/woocommerce/<%= wooCommerceVersion %>/admin/nl/nl_NL/export-translations',
					'PO_FILE=languages/woocommerce/admin-nl_NL.po',
					'touch $PO_FILE',
					'wget -O $PO_FILE $GLOTPRESS_URL'
				].join( '&&' )
	        },
	    	generateMos: {
		    	command: [
		  		    'cd languages',
			    	'for i in **/*.po; do msgfmt $i -o ${i%%.*}.mo; done'
			    ].join( '&&' )
		    },
	    }
	} );

	grunt.loadNpmTasks( 'grunt-phplint' );
	grunt.loadNpmTasks( 'grunt-checkwpversion' );
	grunt.loadNpmTasks( 'grunt-wp-i18n' );
	grunt.loadNpmTasks( 'grunt-shell' );

	// Default task(s).
	grunt.registerTask( 'default', [ 'phplint', 'checkwpversion', 'makepot', 'shell:downloadPo' ] );
	grunt.registerTask( 'downloadPo', [ 'shell:downloadPo', 'shell:downloadAdminPo', 'shell:generateMos' ] );
};
