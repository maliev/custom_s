#!/bin/bash

echo "# Wanna create a new block huh, give me the name?"
read -r -p "-> " blockname
read -r -p "It's $blockname, or what? [y/N] " response
echo "# And now in german:"
read -r -p "-> " blocknameGerman
read -r -p "# Do you need a js file too? [y/N] " jsyesorno
case "$response" in
[yY][eE][sS] | [yY])
  SCRIPT_DIR=$(cd -- "$(dirname -- "${BASH_SOURCE[0]}")" &>/dev/null && pwd)
  ACF_DIR=${SCRIPT_DIR}'/acf-json/'
  RANDOM_ACF_KEY=$(cat /dev/urandom | LC_ALL=C tr -dc 'a-z0-9' | fold -w 13 | head -n 1)
  RANDOM_ACF_FIELD_KEY=$(cat /dev/urandom | LC_ALL=C tr -dc 'a-z0-9' | fold -w 13 | head -n 1)
  RANDOM_ACF_FIELD_MODIFIED=$(cat /dev/urandom | LC_ALL=C tr -dc '1-9' | fold -w 10 | head -n 1)
  SCSS_DIR=${SCRIPT_DIR}'/src/scss/'
  JS_DIR=${SCRIPT_DIR}'/src/js/'
  BLOCK_REGISTER_DIR=${SCRIPT_DIR}'/inc/blocks-registrations/'
  BLOCK_TEMPLATES_DIR=${SCRIPT_DIR}'/template-parts/blocks/'
  cd ${BLOCK_REGISTER_DIR}
  touch "${blockname}.php"
  echo '<?php
        // Register a'${blockname}'block.
        acf_register_block_type( [
			"name"            => "'${blockname}'",
			"title"           => __( "'${blocknameGerman}'" ),
			"description"     => __( "A custom block: '${blocknameGerman}'." ),
			"render_template" => "template-parts/blocks/'${blockname}'.php",
			"mode"            => "edit",
			"align"           => "full",
			"category"        => "custom-blocks",
			"icon"            => "admin-generic",
			"keywords"        => [ "'${blocknameGerman}'" ],
			"example"         => [
				"attributes" => [
					"mode" => "preview",
					"data" => ["_is_preview" => "true",],
				],
				],' >${blockname}.php
  case "$jsyesorno" in [yY][eE][sS] | [yY])
    echo '"enqueue_assets"  => function () {
		if ( ! is_admin() ) {
			wp_enqueue_script( "customs-'${blockname}'-js", filePath( "'${blockname}'.min.js" ), [], fileTimeVersion( "'${blockname}'.min.js" ), true );
		}
	},' >>${blockname}.php
    cd ${SCRIPT_DIR}
    search='entry: {'
    replace=${search}'\n\t\t['"'"${blockname}"'"'] : '"'"'.\/src\/js\/'${blockname}'.js'"'"','
    sed -i '' "s/${search}/${replace}/g" webpack.common.js
    cd ${JS_DIR}
    touch "${blockname}.js"
    echo '#JS file' ${blockname}'.js was created. You have to add a new entry to your webpack.common.js!'
    ;;
  *) ;;
  esac
  cd ${BLOCK_REGISTER_DIR}
  echo '] );' >>${blockname}.php
  cd ${BLOCK_TEMPLATES_DIR}
  touch "${blockname}.php"
  echo '<?php
		/**
		 * '${blocknameGerman}' Block Template.
		 *
		 * @param array $block The block settings and attributes.
		 * @param string $content The block inner HTML (empty).
		 * @param bool $is_preview True during AJAX preview.
		 * @param (int|string) $post_id The post ID this block is saved to.
		 */
		// create class attribute allowing for custom "className" values && adding classes from admin panel if exist
		$className = basename( __FILE__, ".php" ) . ( ! empty( $block["className"] ) ? " " . $block["className"] : "" );
		//frontend
		if ( ! is_admin() ) : ?>
			<section class="section <?= $className ?>">
				<div class="full-width">
					<div class="section__inner">
						<div class="container">

						</div>
					</div>
				</div>
			</section>
		<?php
		//display preview html & on block hover
		elseif ( is_admin() && ( $is_preview ?? "" ) ): $screen = get_current_screen(); ?>
			<img src="<?= get_template_directory_uri() . "/assets/imgs/previews/'${blockname}.png'" ?>" style="width: 100%; height: auto" alt="Preview of what the '${blockname}' custom block is">
		<?php endif;' >${blockname}.php
  cd ${SCSS_DIR}'/components/'
  touch "_${blockname}.scss"
  echo '.'${blockname}' {
	&__ {
	}
}' >_${blockname}.scss
  cd ${SCSS_DIR}
  echo '@import "components/'${blockname}'";' >>main.scss
  cd ${ACF_DIR}
  touch "group_${RANDOM_ACF_FIELD_KEY}.json"
  echo '{
    "key": "group_'${RANDOM_ACF_FIELD_KEY}'",
    "title": "Block: '${blocknameGerman}'",
    "fields": [
        {
            "key": "field_'${RANDOM_ACF_FIELD_KEY}'",
            "label": "Block: '${blocknameGerman}'",
            "name": "",
            "aria-label": "",
            "type": "message",
            "instructions": "",
            "required": 0,
            "conditional_logic": 0,
            "wrapper": {
                "width": "",
                "class": "",
                "id": ""
            },
            "message": "",
            "new_lines": "wpautop",
            "esc_html": 0
        }
    ],
    "location": [
        [
            {
                "param": "block",
                "operator": "==",
                "value": "acf\/'${blockname}'"
            }
        ]
    ],
    "menu_order": 0,
    "position": "normal",
    "style": "default",
    "label_placement": "top",
    "instruction_placement": "label",
    "hide_on_screen": "",
    "active": true,
    "description": "",
    "show_in_rest": 0,
    "modified": '${RANDOM_ACF_FIELD_MODIFIED}'
}' >group_${RANDOM_ACF_FIELD_KEY}.json
  echo "# It's done now. Don't forget to add a preview img for the new block as png!"
  exit 1
  ;;
*)

  exit 0
  ;;
esac
