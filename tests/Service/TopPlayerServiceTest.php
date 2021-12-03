<?php

namespace App\Tests\Service;

use App\Mailer\PlayerMailer;
use App\Repository\PlayerRepository;
use App\Service\TopPlayerService;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class TopPlayerServiceTest extends TestCase
{
    public function testSetup()
    {
        // Dummy "Test Double"
        $playerRepositoryMock = $this->createMock(PlayerRepository::class);
        $playerMailerServiceMock = $this->createMock(PlayerMailer::class);
        $entityManagerMock = $this->createMock(EntityManagerInterface::class);

        $topPlayerService = new TopPlayerService($playerRepositoryMock, $playerMailerServiceMock, $entityManagerMock);

        self::assertTrue(true);
    }

    public function testReward_zeroTopPlayersFound()
    {
        $playerRepositoryMock = $this->createMock(PlayerRepository::class);
        $playerMailerServiceMock = $this->createMock(PlayerMailer::class);
        $entityManagerMock = $this->createMock(EntityManagerInterface::class);

        $playerRepositoryMock->expects($this->atLeastOnce())
            ->method('findTopPlayerForDay');

        $playerMailerServiceMock->expects($this->never())
            ->method('sendTopPlayerEmail');

        $entityManagerMock->expects($this->never())
            ->method('flush');

        $topPlayerService = new TopPlayerService($playerRepositoryMock, $playerMailerServiceMock, $entityManagerMock);
        $topPlayerService->reward();
    }
}
