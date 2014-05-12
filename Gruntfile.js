module.exports = function( grunt ) {
	// Project configuration.
	grunt.initConfig( {
		// Package
		pkg: grunt.file.readJSON( 'package.json' ),

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
					exclude: [ 'deploy/.*', 'wp-svn/.*' ],
					mainFile: 'woocommerce-nl.php',
					type: 'wp-plugin'
				}
			}
		},

		// Shell
		shell: {
			downloadPo: {
				options: {
					project: grunt.option( 'project' ),
					destination: grunt.option( 'destination' ),
				},
				command: [
					'GLOTPRESS_URL=http://glotpress.pronamic.nl/projects/<%= shell.downloadPo.options.project %>/nl/nl_NL/export-translations',
					'PO_FILE=<%= shell.downloadPo.options.destination %>',
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
	    },

	    // Copy
		copy: {
			deploy: {
				src: [
					'**',
					'!.*',
					'!.*/**',
					'!Gruntfile.js',
					'!package.json',
					'!node_modules/**'
				],
				dest: 'deploy',
				expand: true,
				dot: true
			},
		},

		// Clean
		clean: {
			deploy: {
				src: [ 'deploy' ]
			},
		},

		// WordPress deploy
		rt_wp_deploy: {
			app: {
				options: {
					svnUrl: 'http://plugins.svn.wordpress.org/woocommerce-nl/',
					svnDir: 'wp-svn',
					svnUsername: 'pronamic',
					deployDir: 'deploy',
					version: '<%= pkg.version %>',
				}
			}
		},
	} );

	grunt.loadNpmTasks( 'grunt-contrib-copy' );
	grunt.loadNpmTasks( 'grunt-contrib-clean' );
	grunt.loadNpmTasks( 'grunt-phplint' );
	grunt.loadNpmTasks( 'grunt-checkwpversion' );
	grunt.loadNpmTasks( 'grunt-wp-i18n' );
	grunt.loadNpmTasks( 'grunt-shell' );
	grunt.loadNpmTasks( 'grunt-rt-wp-deploy' );

	// Default task(s).
	grunt.registerTask( 'default', [ 'phplint' ] );
	grunt.registerTask( 'downloadPo', [ 'shell:downloadPo', 'shell:generateMos' ] );

	grunt.registerTask( 'deploy', [
		'checkwpversion',
		'clean:deploy',
		'copy:deploy'
	] );

	grunt.registerTask( 'wp-deploy', [
		'deploy',
		'rt_wp_deploy'
	] );
};
