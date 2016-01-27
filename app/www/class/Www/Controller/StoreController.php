<?php

namespace Www\Controller;

use ShoppinPal\Vend\Auth\OAuthResponseDo;
use ShoppinPal\Vend\Auth\TOAuthCallback;
use ShoppinPal\Vend\DiHelper;
use Www\View\Template\StoreAuthorisationErrorTemplate;
use Www\View\Template\StoreAuthorisationSuccessTemplate;
use Www\View\Template\StoreListTemplate;
use YapepBase\Exception\HttpException;

class StoreController extends BaseControllerAbstract
{
    use TOAuthCallback;

    protected function doList()
    {
        // TODO sign the state with HMAC
        $state = json_encode([
            'userId' => $this->authenticationHelper->getLoggedInUserId(),
        ]);

        $this->setToView([
            'stores' => $this->getStoreBo()->getList($this->authenticationHelper->getLoggedInUserId()),
            'connectUrl' => DiHelper::getInstance()->getFactory()->getOAuth()->getAuthorisationRedirectUrl($state),
        ]);

        return new StoreListTemplate('stores', 'connectUrl');
    }

    protected function getRequest()
    {
        return $this->request;
    }

    protected function processOAuthAuthorisationCallbackError($errorMessage)
    {
        trigger_error(sprintf('Error received by OAuth callback: "%s"', $errorMessage), E_USER_WARNING);

        $this->setToView([
            'error' => $errorMessage,
        ]);

        return new StoreAuthorisationErrorTemplate('error');
    }

    protected function processOAuthAuthorisationCallbackSuccess(OAuthResponseDo $responseDo, $domainPrefix, $state)
    {
        $parsedState = json_decode($state, true);

        if (empty($parsedState['userId'])) {
            throw new HttpException('No userID received', 400);
        }

        // Todo verify the state with hmac
        $this->getStoreBo()->create(
            (int)$parsedState['userId'],
            $domainPrefix,
            $responseDo->accessToken,
            $responseDo->tokenType,
            $responseDo->expires,
            $responseDo->refreshToken
        );

        $this->setToView([
            'domainPrefix' => $domainPrefix,
        ]);

        return new StoreAuthorisationSuccessTemplate('domainPrefix');
    }

}
