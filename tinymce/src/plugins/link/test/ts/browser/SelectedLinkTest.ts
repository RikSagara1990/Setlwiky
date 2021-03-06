import { Assertions } from '@ephox/agar';
import { Chain } from '@ephox/agar';
import { GeneralSteps } from '@ephox/agar';
import { Logger } from '@ephox/agar';
import { Pipeline } from '@ephox/agar';
import { UiControls } from '@ephox/agar';
import { UiFinder } from '@ephox/agar';
import { TinyApis } from '@ephox/mcagar';
import { TinyLoader } from '@ephox/mcagar';
import { TinyUi } from '@ephox/mcagar';
import LinkPlugin from 'tinymce/plugins/link/Plugin';
import ModernTheme from 'tinymce/themes/modern/Theme';
import { UnitTest } from '@ephox/bedrock';

UnitTest.asynctest('browser.tinymce.plugins.link.SelectedLinkTest', function () {
  const success = arguments[arguments.length - 2];
  const failure = arguments[arguments.length - 1];

  ModernTheme();
  LinkPlugin();

  TinyLoader.setup(function (editor, onSuccess, onFailure) {
    const tinyApis = TinyApis(editor);
    const tinyUi = TinyUi(editor);

    Pipeline.async({}, [
      Logger.t('should not get anchor info if not selected node', GeneralSteps.sequence([
        tinyApis.sSetContent('<p><a href="http://tinymce.com">tiny</a></p>'),
        tinyApis.sSetSelection([0], 1, [0], 1),
        tinyApis.sExecCommand('mcelink'),
        Chain.asStep({}, [
          tinyUi.cWaitForPopup('wait for link popup', 'div[role="dialog"][aria-label="Insert link"]'),
          UiFinder.cFindIn('label:contains("Url") + div > input'),
          UiControls.cGetValue,
          Assertions.cAssertEq('assert value is nothing', '')
        ])
      ]))
    ], onSuccess, onFailure);
  }, {
    plugins: 'link',
    toolbar: '',
    skin_url: '/project/js/tinymce/skins/lightgray'
  }, success, failure);
});
