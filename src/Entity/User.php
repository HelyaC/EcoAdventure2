<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: '`user`')]

class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: DailyQuizLimit::class, cascade: ['persist', 'remove'])]
   
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(nullable: true)]
    private ?int $ecoScore = null;

    #[ORM\Column(nullable: true)]
    private ?int $placement = null;

    #[ORM\Column(nullable: true)]
    private ?bool $newsletterSubscription = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $createdAt = null;

    /**
     * @var Collection<int, DailyQuizLimit>
     */
    #[ORM\OneToMany(targetEntity: DailyQuizLimit::class, mappedBy: 'user_id')]
    private Collection $dailyQuizLimits;

    /**
     * @var Collection<int, ChatBotMessage>
     */
    #[ORM\OneToMany(targetEntity: ChatBotMessage::class, mappedBy: 'userId')]
    private Collection $chatBotMessages;

    /**
     * @var Collection<int, CarbonFootPrint>
     */
    #[ORM\OneToMany(targetEntity: CarbonFootPrint::class, mappedBy: 'userId')]
    private Collection $carbonFootPrints;

    /**
     * @var Collection<int, NewsletterSubscription>
     */
    #[ORM\OneToMany(targetEntity: NewsletterSubscription::class, mappedBy: 'userId')]
    private Collection $newsletterSubscriptions;

    /**
     * @var Collection<int, Role>
     */
    #[ORM\ManyToMany(targetEntity: Role::class, mappedBy: 'userId')]
    private Collection $roles;

    /**
     * @var Collection<int, UserBadge>
     */
    #[ORM\ManyToMany(targetEntity: UserBadge::class, mappedBy: 'userId')]
    private Collection $userBadges;

    /**
     * @var Collection<int, Notification>
     */
    #[ORM\OneToMany(targetEntity: Notification::class, mappedBy: 'userId')]
    private Collection $notifications;

    /**
     * @var Collection<int, Recommendation>
     */
    #[ORM\OneToMany(targetEntity: Recommendation::class, mappedBy: 'userId')]
    private Collection $recommendations;

    /**
     * @var Collection<int, UserChallenge>
     */
    #[ORM\OneToMany(targetEntity: UserChallenge::class, mappedBy: 'userId')]
    private Collection $userChallenges;

    /**
     * @var Collection<int, Challenge>
     */
    #[ORM\OneToMany(targetEntity: Challenge::class, mappedBy: 'userId')]
    private Collection $challenges;

    /**
     * @var Collection<int, Contact>
     */
    #[ORM\OneToMany(targetEntity: Contact::class, mappedBy: 'userId')]
    private Collection $contacts;

    /**
     * @var Collection<int, Friend>
     */
    #[ORM\OneToMany(targetEntity: Friend::class, mappedBy: 'userId')]
    private Collection $friends;

    public function __construct()
    {
        $this->dailyQuizLimits = new ArrayCollection();
        $this->chatBotMessages = new ArrayCollection();
        $this->carbonFootPrints = new ArrayCollection();
        $this->newsletterSubscriptions = new ArrayCollection();
        $this->roles = new ArrayCollection();
        $this->userBadges = new ArrayCollection();
        $this->notifications = new ArrayCollection();
        $this->recommendations = new ArrayCollection();
        $this->userChallenges = new ArrayCollection();
        $this->challenges = new ArrayCollection();
        $this->contacts = new ArrayCollection();
        $this->friends = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getEcoScore(): ?int
    {
        return $this->ecoScore;
    }

    public function setEcoScore(?int $ecoScore): static
    {
        $this->ecoScore = $ecoScore;

        return $this;
    }

    public function getPlacement(): ?int
    {
        return $this->placement;
    }

    public function setPlacement(?int $placement): static
    {
        $this->placement = $placement;

        return $this;
    }

    public function isNewsletterSubscription(): ?bool
    {
        return $this->newsletterSubscription;
    }

    public function setNewsletterSubscription(?bool $newsletterSubscription): static
    {
        $this->newsletterSubscription = $newsletterSubscription;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, DailyQuizLimit>
     */
    public function getDailyQuizLimits(): Collection
    {
        return $this->dailyQuizLimits;
    }

    public function addDailyQuizLimit(DailyQuizLimit $dailyQuizLimit): static
    {
        if (!$this->dailyQuizLimits->contains($dailyQuizLimit)) {
            $this->dailyQuizLimits->add($dailyQuizLimit);
            $dailyQuizLimit->setUser($this);
        }

        return $this;
    }

    public function removeDailyQuizLimit(DailyQuizLimit $dailyQuizLimit): static
    {
        if ($this->dailyQuizLimits->removeElement($dailyQuizLimit)) {
            // set the owning side to null (unless already changed)
            if ($dailyQuizLimit->getUser() === $this) {
                $dailyQuizLimit->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ChatBotMessage>
     */
    public function getChatBotMessages(): Collection
    {
        return $this->chatBotMessages;
    }

    public function addChatBotMessage(ChatBotMessage $chatBotMessage): static
    {
        if (!$this->chatBotMessages->contains($chatBotMessage)) {
            $this->chatBotMessages->add($chatBotMessage);
            $chatBotMessage->setUserId($this);
        }

        return $this;
    }

    public function removeChatBotMessage(ChatBotMessage $chatBotMessage): static
    {
        if ($this->chatBotMessages->removeElement($chatBotMessage)) {
            // set the owning side to null (unless already changed)
            if ($chatBotMessage->getUserId() === $this) {
                $chatBotMessage->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CarbonFootPrint>
     */
    public function getCarbonFootPrints(): Collection
    {
        return $this->carbonFootPrints;
    }

    public function addCarbonFootPrint(CarbonFootPrint $carbonFootPrint): static
    {
        if (!$this->carbonFootPrints->contains($carbonFootPrint)) {
            $this->carbonFootPrints->add($carbonFootPrint);
            $carbonFootPrint->setUserId($this);
        }

        return $this;
    }

    public function removeCarbonFootPrint(CarbonFootPrint $carbonFootPrint): static
    {
        if ($this->carbonFootPrints->removeElement($carbonFootPrint)) {
            // set the owning side to null (unless already changed)
            if ($carbonFootPrint->getUserId() === $this) {
                $carbonFootPrint->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, NewsletterSubscription>
     */
    public function getNewsletterSubscriptions(): Collection
    {
        return $this->newsletterSubscriptions;
    }

    public function addNewsletterSubscription(NewsletterSubscription $newsletterSubscription): static
    {
        if (!$this->newsletterSubscriptions->contains($newsletterSubscription)) {
            $this->newsletterSubscriptions->add($newsletterSubscription);
            $newsletterSubscription->setUserId($this);
        }

        return $this;
    }

    public function removeNewsletterSubscription(NewsletterSubscription $newsletterSubscription): static
    {
        if ($this->newsletterSubscriptions->removeElement($newsletterSubscription)) {
            // set the owning side to null (unless already changed)
            if ($newsletterSubscription->getUserId() === $this) {
                $newsletterSubscription->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Role>
     */
    public function getRoles(): Collection
    {
        return $this->roles;
    }

    public function addRole(Role $role): static
    {
        if (!$this->roles->contains($role)) {
            $this->roles->add($role);
            $role->addUserId($this);
        }

        return $this;
    }

    public function removeRole(Role $role): static
    {
        if ($this->roles->removeElement($role)) {
            $role->removeUserId($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, UserBadge>
     */
    public function getUserBadges(): Collection
    {
        return $this->userBadges;
    }

    public function addUserBadge(UserBadge $userBadge): static
    {
        if (!$this->userBadges->contains($userBadge)) {
            $this->userBadges->add($userBadge);
            $userBadge->addUserId($this);
        }

        return $this;
    }

    public function removeUserBadge(UserBadge $userBadge): static
    {
        if ($this->userBadges->removeElement($userBadge)) {
            $userBadge->removeUserId($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Notification>
     */
    public function getNotifications(): Collection
    {
        return $this->notifications;
    }

    public function addNotification(Notification $notification): static
    {
        if (!$this->notifications->contains($notification)) {
            $this->notifications->add($notification);
            $notification->setUserId($this);
        }

        return $this;
    }

    public function removeNotification(Notification $notification): static
    {
        if ($this->notifications->removeElement($notification)) {
            // set the owning side to null (unless already changed)
            if ($notification->getUserId() === $this) {
                $notification->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Recommendation>
     */
    public function getRecommendations(): Collection
    {
        return $this->recommendations;
    }

    public function addRecommendation(Recommendation $recommendation): static
    {
        if (!$this->recommendations->contains($recommendation)) {
            $this->recommendations->add($recommendation);
            $recommendation->setUserId($this);
        }

        return $this;
    }

    public function removeRecommendation(Recommendation $recommendation): static
    {
        if ($this->recommendations->removeElement($recommendation)) {
            // set the owning side to null (unless already changed)
            if ($recommendation->getUserId() === $this) {
                $recommendation->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UserChallenge>
     */
    public function getUserChallenges(): Collection
    {
        return $this->userChallenges;
    }

    public function addUserChallenge(UserChallenge $userChallenge): static
    {
        if (!$this->userChallenges->contains($userChallenge)) {
            $this->userChallenges->add($userChallenge);
            $userChallenge->setUserId($this);
        }

        return $this;
    }

    public function removeUserChallenge(UserChallenge $userChallenge): static
    {
        if ($this->userChallenges->removeElement($userChallenge)) {
            // set the owning side to null (unless already changed)
            if ($userChallenge->getUserId() === $this) {
                $userChallenge->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Challenge>
     */
    public function getChallenges(): Collection
    {
        return $this->challenges;
    }

    public function addChallenge(Challenge $challenge): static
    {
        if (!$this->challenges->contains($challenge)) {
            $this->challenges->add($challenge);
            $challenge->setUserId($this);
        }

        return $this;
    }

    public function removeChallenge(Challenge $challenge): static
    {
        if ($this->challenges->removeElement($challenge)) {
            // set the owning side to null (unless already changed)
            if ($challenge->getUserId() === $this) {
                $challenge->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Contact>
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): static
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts->add($contact);
            $contact->setUserId($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): static
    {
        if ($this->contacts->removeElement($contact)) {
            // set the owning side to null (unless already changed)
            if ($contact->getUserId() === $this) {
                $contact->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Friend>
     */
    public function getFriends(): Collection
    {
        return $this->friends;
    }

    public function addFriend(Friend $friend): static
    {
        if (!$this->friends->contains($friend)) {
            $this->friends->add($friend);
            $friend->setUserId($this);
        }

        return $this;
    }

    public function removeFriend(Friend $friend): static
    {
        if ($this->friends->removeElement($friend)) {
            // set the owning side to null (unless already changed)
            if ($friend->getUserId() === $this) {
                $friend->setUserId(null);
            }
        }

        return $this;
    }
}
