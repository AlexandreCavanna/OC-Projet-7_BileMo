<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use OpenApi\Annotations as OA;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups(groups="show_customer_users_index")
     * @Groups(groups="show_customer_user_details")
     * @Groups(groups="create_user")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups(groups="show_customer_users_index")
     * @Groups(groups="show_customer_user_details")
     * @Groups(groups="create_user")
     * @OA\Property(description="firstname of user.", maxLength=255)
     */
    private string $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups(groups="show_customer_users_index")
     * @Groups(groups="show_customer_user_details")
     * @Groups(groups="create_user")
     * @OA\Property(description="lastname of user.", maxLength=255)
     */
    private string $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups(groups="show_customer_users_index")
     * @Groups(groups="show_customer_user_details")
     * @Groups(groups="create_user")
     * @OA\Property(description="email of user.", maxLength=255)
     */
    private string $email;

    /**
     * @ORM\Column(type="datetime")
     * @Groups(groups="show_customer_users_index")
     * @Groups(groups="show_customer_user_details")
     * @Groups(groups="create_user")
     * @OA\Property(description="date when user has been created.")
     */
    private \DateTime $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="users", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups(groups="create_user")
     * @OA\Property(description="date when user has been created."))
     */
    private Customer $customer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

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

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }
}
