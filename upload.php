<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

    <?php 
        // Gets the file
        $file = $_FILES['file'];
        // Creates directory for the uploaded files
        $dir = __DIR__ . '\uploads\\';

        // Get the date in order to get a name plus the time uploaded for the files
        $zipname = time() . '_' . $file['name'];
        $filename = str_replace('.zip', '', $zipname);

        // Move to uploads directory
        move_uploaded_file($file['tmp_name'], $dir . $zipname);

        $zip = new ZipArchive;

        if ($zip->open($dir . $zipname)) {
            // Extracts the file into the name uploads route
            $zip->extractTo($dir . $filename);
            $zip->close();// Always close after finished

            unlink($dir . $zipname);
        }

        function load($filepath, $filedir = '')
        {
            /* Creates the visual extrated file */
            global $dir;

            // Access to all the directories inside the extracted file
            $path = rtrim($dir . $filedir, '/') . '/' . $filepath;
            $list = array_diff(scandir($path), array('.', '..'));
            $html = '';

            // Folders
            foreach ($list as $file) {
                $nowFilePath = $path . '/' . $file;
                // If it is a directory displays a folder icon
                if (is_dir($nowFilePath)) {
                    $dirHTML = load($file, $filedir . $filepath . '/');
                    $html .= "
                        <span class='folder'>
                            <img src='folder.png' class='folder-img' alt='folder'>
                            {$file}
                        </span>
                        <ul class='list'>
                            {$dirHTML}
                        </ul>
                    ";
                }
            }

            // Files inside folders
            foreach ($list as $file) {
                $nowFilePath = $path . '/' . $file;
                $downPath = $filedir . $filepath . '/' . $file;
                // If it is a file displays a file icon
                if (is_file($nowFilePath)) {
                    $html .= "
                        <li class='file'>
                            <img src='file.png' class='file-img' alt='file'>
                            <a href='uploads/{$downPath}' download='{$file}'>{$file}</a>
                        </li>
                    ";
                }
            }

            return $html;
        }

        $html = load($filename);
    ?>
    
    <div class="uploader">
        <h2 class="uploader-title"><?=$file['name']?> (<?=number_format($file['size'] / 1024 / 1024, 2)?>MB)</h2>
        <ul class="list">
            <?=$html?>
            <!-- <span class="folder">
                <img src="folder.png" class="folder-img" alt="folder">
                css
            </span>
            <ul class="list">
                <li class="file">
                    <img src="file.png" class="file-img" alt="file">
                    <a href="/uploads/bulma-0.7.4/css/bulma.css" download="">bulma.css</a>
                </li>
                <li class="file">
                    <img src="file.png" class="file-img" alt="file">
                    <a href="/uploads/bulma-0.7.4/css/bulma.css.map" download="">bulma.css.map</a>
                </li>
                <li class="file">
                    <img src="file.png" class="file-img" alt="file">
                    <a href="/uploads/bulma-0.7.4/css/bulma.min.css" download="">bulma.min.css</a>
                </li>
            </ul><span class="folder">
                <img src="folder.png" class="folder-img" alt="folder">
                sass
            </span>
            <ul class="list">
                <span class="folder">
                    <img src="folder.png" class="folder-img" alt="folder">
                    base
                </span>
                <ul class="list">
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/base/_all.sass" download="">_all.sass</a>
                    </li>
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/base/generic.sass" download="">generic.sass</a>
                    </li>
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/base/helpers.sass" download="">helpers.sass</a>
                    </li>
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/base/minireset.sass" download="">minireset.sass</a>
                    </li>
                </ul><span class="folder">
                    <img src="folder.png" class="folder-img" alt="folder">
                    components
                </span>
                <ul class="list">
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/components/_all.sass" download="">_all.sass</a>
                    </li>
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/components/breadcrumb.sass" download="">breadcrumb.sass</a>
                    </li>
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/components/card.sass" download="">card.sass</a>
                    </li>
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/components/dropdown.sass" download="">dropdown.sass</a>
                    </li>
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/components/level.sass" download="">level.sass</a>
                    </li>
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/components/list.sass" download="">list.sass</a>
                    </li>
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/components/media.sass" download="">media.sass</a>
                    </li>
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/components/menu.sass" download="">menu.sass</a>
                    </li>
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/components/message.sass" download="">message.sass</a>
                    </li>
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/components/modal.sass" download="">modal.sass</a>
                    </li>
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/components/navbar.sass" download="">navbar.sass</a>
                    </li>
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/components/pagination.sass" download="">pagination.sass</a>
                    </li>
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/components/panel.sass" download="">panel.sass</a>
                    </li>
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/components/tabs.sass" download="">tabs.sass</a>
                    </li>
                </ul><span class="folder">
                    <img src="folder.png" class="folder-img" alt="folder">
                    elements
                </span>
                <ul class="list">
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/elements/_all.sass" download="">_all.sass</a>
                    </li>
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/elements/box.sass" download="">box.sass</a>
                    </li>
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/elements/button.sass" download="">button.sass</a>
                    </li>
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/elements/container.sass" download="">container.sass</a>
                    </li>
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/elements/content.sass" download="">content.sass</a>
                    </li>
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/elements/form.sass" download="">form.sass</a>
                    </li>
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/elements/icon.sass" download="">icon.sass</a>
                    </li>
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/elements/image.sass" download="">image.sass</a>
                    </li>
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/elements/notification.sass" download="">notification.sass</a>
                    </li>
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/elements/other.sass" download="">other.sass</a>
                    </li>
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/elements/progress.sass" download="">progress.sass</a>
                    </li>
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/elements/table.sass" download="">table.sass</a>
                    </li>
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/elements/tag.sass" download="">tag.sass</a>
                    </li>
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/elements/title.sass" download="">title.sass</a>
                    </li>
                </ul><span class="folder">
                    <img src="folder.png" class="folder-img" alt="folder">
                    grid
                </span>
                <ul class="list">
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/grid/_all.sass" download="">_all.sass</a>
                    </li>
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/grid/columns.sass" download="">columns.sass</a>
                    </li>
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/grid/tiles.sass" download="">tiles.sass</a>
                    </li>
                </ul><span class="folder">
                    <img src="folder.png" class="folder-img" alt="folder">
                    layout
                </span>
                <ul class="list">
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/layout/_all.sass" download="">_all.sass</a>
                    </li>
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/layout/footer.sass" download="">footer.sass</a>
                    </li>
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/layout/hero.sass" download="">hero.sass</a>
                    </li>
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/layout/section.sass" download="">section.sass</a>
                    </li>
                </ul><span class="folder">
                    <img src="folder.png" class="folder-img" alt="folder">
                    utilities
                </span>
                <ul class="list">
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/utilities/_all.sass" download="">_all.sass</a>
                    </li>
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/utilities/animations.sass" download="">animations.sass</a>
                    </li>
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/utilities/controls.sass" download="">controls.sass</a>
                    </li>
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/utilities/derived-variables.sass"
                            download="">derived-variables.sass</a>
                    </li>
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/utilities/functions.sass" download="">functions.sass</a>
                    </li>
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/utilities/initial-variables.sass"
                            download="">initial-variables.sass</a>
                    </li>
                    <li class="file">
                        <img src="file.png" class="file-img" alt="file">
                        <a href="/uploads/bulma-0.7.4/sass/utilities/mixins.sass" download="">mixins.sass</a>
                    </li>
                </ul>
                <li class="file">
                    <img src="file.png" class="file-img" alt="file">
                    <a href="/uploads/bulma-0.7.4/sass/.DS_Store" download="">.DS_Store</a>
                </li>
            </ul>
            <li class="file">
                <img src="file.png" class="file-img" alt="file">
                <a href="/uploads/bulma-0.7.4/CHANGELOG.md" download="">CHANGELOG.md</a>
            </li>
            <li class="file">
                <img src="file.png" class="file-img" alt="file">
                <a href="/uploads/bulma-0.7.4/LICENSE" download="">LICENSE</a>
            </li>
            <li class="file">
                <img src="file.png" class="file-img" alt="file">
                <a href="/uploads/bulma-0.7.4/README.md" download="">README.md</a>
            </li>
            <li class="file">
                <img src="file.png" class="file-img" alt="file">
                <a href="/uploads/bulma-0.7.4/bulma.sass" download="">bulma.sass</a>
            </li>
            <li class="file">
                <img src="file.png" class="file-img" alt="file">
                <a href="/uploads/bulma-0.7.4/package.json" download="">package.json</a>
            </li> -->
        </ul>
    </div>

</body>
</html>