import { ApproxStructure } from '@ephox/agar';
import { Pipeline } from '@ephox/agar';
import { TinyApis } from '@ephox/mcagar';
import { TinyLoader } from '@ephox/mcagar';
import { TinyUi } from '@ephox/mcagar';
import HrPlugin from 'tinymce/plugins/hr/Plugin';
import ModernTheme from 'tinymce/themes/modern/Theme';
import { UnitTest } from '@ephox/bedrock';

UnitTest.asynctest('browser.tinymce.plugins.fullscreen.HrSanitytest', function () {
  const success = arguments[arguments.length - 2];
  const failure = arguments[arguments.length - 1];

  ModernTheme();
  HrPlugin();

  TinyLoader.setup(function (editor, onSuccess, onFailure) {
    const tinyUi = TinyUi(editor);
    const tinyApis = TinyApis(editor);
    Pipeline.async({}, [
      tinyUi.sClickOnToolbar('click on hr button', 'div[aria-label="Horizontal line"] > button'),
      tinyApis.sAssertContentStructure(ApproxStructure.build(function (s, str) {
        return s.element('body', {
          children: [
            s.element('hr', {}),
            s.anything()
          ]
        });
      }))
    ], onSuccess, onFailure);
  }, {
    plugins: 'hr',
    toolbar: 'hr',
    skin_url: '/project/js/tinymce/skins/lightgray'
  }, success, failure);
});
