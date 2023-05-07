<?php


namespace Tests\Acceptance;

use Codeception\Attribute\Given;
use Codeception\Attribute\When;
use Codeception\Attribute\Then;

use Tests\Support\AcceptanceTester;

class CreateCustomerCest
{
    #[Given('I am in creation page')]
    public function iWantToCreateCusotmer(AcceptanceTester $I)
    {
        $I->amOnPage('/customers/create');
        $I->fillField('first_name','davert');
        $I->fillField('last_name','qwerty');
        $I->fillField('email','email@qwerty.com');
        $I->fillField('phone_number','+989123456785');
        $I->fillField('date_of_birth','1985-02-15');
        $I->fillField('bank_account_number','123456789852');
    }

    #[When('I go to creation process')]
    public function iGoToCreationProcess(AcceptanceTester $I)
    {
        $I->amOnPage('/customers/create');
        $I->click("Create Customer");
        $I->amGoingTo('/customers');
    }

    #[Then('I can see customers in my list')]
    public function iCanSeeCustomerInMyList(AcceptanceTester $I)
    {
        $I->amOnPage('/customers');
        $I->see('davert');
    }
}
