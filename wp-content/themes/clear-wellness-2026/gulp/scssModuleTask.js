const fs = require("fs");
const sources  = require( "./sources.js");

const module_template = '@use "abstracts" as *;\n@mixin {module_name}{\n  .{module_name}{\n\n  }\n}';

function checkFileDoesntExist( file ) {
    if( fs.existsSync( file )) {
        console.error('\x1b[31m%s\x1b[0m', 'ERROR: file ' + file + ' already exists');
        return false;
    }
    return true;
}

module.exports = function(done){

    const args  = process.argv;

    const module_name = args.pop().substr(2);

    const modules_index_file = sources.css.modules_index;
    const modules_list_file = sources.css.modules_list;
    const output_module_file = sources.css.modules_dir + '_' + module_name + '.scss';

    if (arguments.length === 0) {
        console.error('\x1b[31m%s\x1b[0m', 'ERROR: You must specify the module name. Example: gulp module --moduleName');
    } else {

        if( checkFileDoesntExist( output_module_file ) ){

            // Add @forward to modules/_index.scss
            fs.readFile(modules_index_file, 'utf8', function(err, index_contents){
                if(err) {
                    console.error('\x1b[31m%s\x1b[0m', 'ERROR: Could not read ' + modules_index_file);
                    done();
                    return;
                }

                index_contents += '@forward "' + module_name + '";\n';
                fs.writeFileSync(modules_index_file, index_contents);
                console.log('\x1b[32m%s\x1b[0m', 'Added @forward to ' + modules_index_file.replaceAll('./', '') );

                // Add mixin to _modulesList.scss
                fs.readFile(modules_list_file, 'utf8', function(err, list_contents){
                    if(err) {
                        console.error('\x1b[31m%s\x1b[0m', 'ERROR: Could not read ' + modules_list_file);
                        done();
                        return;
                    }

                    // Find the last @include and add the new one after it
                    const lines = list_contents.split('\n');
                    let lastIncludeIndex = -1;
                    for(let i = lines.length - 1; i >= 0; i--) {
                        if(lines[i].trim().startsWith('@include')) {
                            lastIncludeIndex = i;
                            break;
                        }
                    }

                    if(lastIncludeIndex >= 0) {
                        lines.splice(lastIncludeIndex + 1, 0, '  @include ' + module_name + ';');
                        list_contents = lines.join('\n');
                    } else {
                        // Fallback: add before closing brace
                        list_contents = list_contents.replace(/\n}/, '\n  @include ' + module_name + ';\n}');
                    }

                    fs.writeFileSync(modules_list_file, list_contents);
                    console.log('\x1b[32m%s\x1b[0m', 'Added @include to ' + modules_list_file.replaceAll('./', '') );

                    // Create the new module file
                    fs.writeFileSync(output_module_file, module_template.replaceAll('{module_name}', module_name ));
                    console.log('\x1b[32m%s\x1b[0m', 'File created successfully: ' + output_module_file.replaceAll('./', '') );

                    done();
                });
            });
        } else {
            done();
        }
    }

}

