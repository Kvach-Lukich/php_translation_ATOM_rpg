Локализатор модов для ATOM rpg

Установка:
1. скачать php8 https://windows.php.net/download/
x64 Non Thread Safe https://windows.php.net/downloads/releases/php-8.0.7-nts-Win32-vs16-x64.zip (актуальная на момент написания)
2. Распаковать в директорию php этого проекта. (не грохнуть настроенный php.ini)
3. Проверить установлена ли Visual C++ Redistributable for Visual Studio 2015-2019 (слева на странице есть ссылки на инсталлер) https://aka.ms/vs/16/release/VC_redist.x64.exe

Использование:

0. настроить конфигурацию в файле scripts/config.php
1. если мод уже локализирован - то обязательно внести все текущии локализации в массив в конфиге
2. запустить mkall.cmd - появится all.json 1 файл со всеми текущими локализациями
3. удалить из массива конфига текущие локализации и добавить новые, на котороые нужно перевести
4. запустить translate.cmd (ждём гугль) - открыть обновлённый all.json , проверить чтобы ни где не слетели темплейты встроенные в текст ($имя_темплеа$ или [d]имя_темплеа[/d])
5. запустить build.cmd файлы локализаций создадуться автоматически с префиксом имени мода.
Основная задача Done!
6. при изменении в проекте , в unity запустить Game->Localization->Generate Localization (придётся подождать - займёт время). unity должен пересоздать файл локализации но без префикса мода - в нём как раз и будут все новые/изменённые ноды
7. запустить mkdiff.cmd - появится diff.json только с обновлёнными нодами и в нём уже будут добавлены все локализации (гугль)
8. запустить applydiff.cmd - обновится основной файл all.json с добавленными изменениями, кроме удаления нодов, которые были удалены через unity, их можно вручную вырезать из all.json или произвести полную синхронизацию*
9. см п.5

10. полная синхронизация - делокализация*: запустить delocalise.cmd - заменит все ссылки на текст из all.json там где вместо текста ссылки т.е. если делокализировать объекты в которых есть нормальный текст, тот этот текст не пострадает.
Если включена опция в конфиге - в комментарии к каждой ноде будет текст со всеми переводами в спец тегах локали - эти комменты будут перезаписываться при каждой делокализации, а старые комменты, написанные разработчиком, не пострадают.
11. создание основного файла из объектов с комментами + файла локализации от unity allfromunity.cmd - полезно для круговой синхронизации основного файла и данными из unity.
