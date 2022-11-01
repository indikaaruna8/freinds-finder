<?php

namespace In\Entity;

use Doctrine\ORM\Mapping as ORM;
use In\Repository\AdminRepository;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AdminRepository::class)
 *  @ORM\HasLifecycleCallbacks()
 */
class Admin
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="uuid", unique=true)
     */
    private $uuid;

    /**
     * @Assert\NotBlank
     * @Assert\Email
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $username;

    /**
     * Display Name
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $updatedAt;

    /**
     * Each admin has a role
     * @ORM\ManyToOne(targetEntity="AdminRole", inversedBy="admins")
     * @ORM\JoinColumn(name="admin_role_id", referencedColumnName="id")
     * @var AdminRole
     */
    private $adminRole;

    /**
     * @ORM\ManyToOne(targetEntity="AdminProfile")
     * @ORM\JoinColumn(name="address_id", referencedColumnName="id")
     */
    private AdminProfile $profile;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid()
    {
        return $this->uuid;
    }

    public function setUuid($uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue(): void
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
        $this->uuid = \Symfony\Component\Uid\Uuid::v4();
        $this->username = $this->email;
    }

    public function getAdminRole(): ?AdminRole
    {
        return $this->adminRole;
    }

    public function setAdminRole(?AdminRole $adminRole): self
    {
        $this->adminRole = $adminRole;

        return $this;
    }

    public function getProfile(): ?AdminProfile
    {
        return $this->profile;
    }

    public function setProfile(?AdminProfile $profile): self
    {
        $this->profile = $profile;

        return $this;
    }

}
