"use server";

import nodemailer from "nodemailer";

export async function sendInquiry(formData: FormData) {
  const name = formData.get("name") as string;
  const email = formData.get("email") as string;
  const phone = formData.get("phone") as string;
  const message = formData.get("message") as string;

  if (!name || !email || !message) {
    return { success: false, message: "Please fill in all required fields." };
  }

  // Use environment variables for security
  // Fallback to legacy credentials for initial setup (User should update these in Vercel)
  const user = process.env.GMAIL_USER || "agootechnology@gmail.com";
  const pass = process.env.GMAIL_PASS || "xpzmjypkdhgzpnvz"; 

  const transporter = nodemailer.createTransport({
    service: "gmail",
    auth: { user, pass },
  });

  try {
    await transporter.sendMail({
      from: `"${name}" <${user}>`,
      to: "info@agoo.in", // As per legacy code
      replyTo: email,
      subject: `New Contact Inquiry from ${name} (JJ Media House)`,
      html: `
        <div style="font-family: sans-serif; max-width: 600px; margin: auto; padding: 20px; border: 1px solid #eee;">
          <h2 style="color: #3e83f4;">New Contact Inquiry</h2>
          <p><strong>Name:</strong> ${name}</p>
          <p><strong>Email:</strong> ${email}</p>
          <p><strong>Phone:</strong> ${phone || "N/A"}</p>
          <hr />
          <p><strong>Message:</strong></p>
          <p style="white-space: pre-wrap;">${message}</p>
        </div>
      `,
    });

    return { success: true, message: "Thank you! Your message has been sent successfully." };
  } catch (error) {
    console.error("Email error:", error);
    return { success: false, message: "An error occurred while sending the message. Please try again later." };
  }
}
