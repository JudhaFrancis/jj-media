"use client";

import { useState } from "react";
import { motion } from "framer-motion";
import { Phone, Mail, MapPin, Loader2 } from "lucide-react";
import { sendInquiry } from "@/app/actions";

export default function ContactForm() {
  const [status, setStatus] = useState<{ message: string; type: "success" | "error" | null }>({
    message: "",
    type: null,
  });
  const [loading, setLoading] = useState(false);

  async function handleSubmit(e: React.FormEvent<HTMLFormElement>) {
    e.preventDefault();
    setLoading(true);
    setStatus({ message: "Sending message...", type: null });

    const formData = new FormData(e.currentTarget);
    const result = await sendInquiry(formData);

    if (result.success) {
      setStatus({ message: result.message, type: "success" });
      (e.target as HTMLFormElement).reset();
    } else {
      setStatus({ message: result.message, type: "error" });
    }
    setLoading(false);
  }

  return (
    <section id="contact" className="py-24 md:py-32 px-6 md:px-24 bg-brand-bg relative overflow-hidden">
      <div className="absolute top-0 right-0 w-1/2 h-full bg-brand-gold/5 -skew-x-12 translate-x-1/2 pointer-events-none"></div>
      
      <div className="grid grid-cols-1 lg:grid-cols-2 gap-20 relative z-10">
        <motion.div
          initial={{ opacity: 0, x: -30 }}
          whileInView={{ opacity: 1, x: 0 }}
          viewport={{ once: true }}
        >
          <h2 className="text-5xl md:text-8xl font-heading font-black leading-tight mb-8">
            Let&apos;s Build<br />Something <span className="text-brand-gold italic">Bold.</span>
          </h2>
          <p className="text-xl text-brand-muted mb-12">
            Ready to make your brand unmissable? Our media planners are ready to draft your visibility strategy.
          </p>
          
          <div className="space-y-10">
            {[
              { icon: <Phone className="w-5 h-5" />, label: "Call Our Office", value: "+91 99999 99999" },
              { icon: <Mail className="w-5 h-5" />, label: "Email Inquiry", value: "hello@jjmedia.in" },
              { icon: <MapPin className="w-5 h-5" />, label: "Headquarters", value: "Bengaluru, India" },
            ].map((item, idx) => (
              <div key={idx} className="flex items-start space-x-6">
                <div className="w-12 h-12 flex items-center justify-center border border-brand-gold/30 text-brand-gold">
                  {item.icon}
                </div>
                <div>
                  <p className="text-[10px] uppercase tracking-[0.3em] text-brand-muted mb-1">{item.label}</p>
                  <p className="text-xl font-bold">{item.value}</p>
                </div>
              </div>
            ))}
          </div>
        </motion.div>

        <motion.div
          initial={{ opacity: 0, x: 30 }}
          whileInView={{ opacity: 1, x: 0 }}
          viewport={{ once: true }}
          transition={{ delay: 0.3 }}
        >
          <form onSubmit={handleSubmit} className="bg-brand-card p-10 md:p-14 border border-white/10 shadow-2xl space-y-8">
            {status.message && (
              <div className={`p-4 border text-center font-bold uppercase tracking-widest text-sm transition-all ${
                status.type === "success" ? "border-emerald-500/50 bg-emerald-500/10 text-emerald-500" : 
                status.type === "error" ? "border-red-500/50 bg-red-500/10 text-red-500" : 
                "border-brand-gold/50 bg-brand-gold/10 text-brand-gold"
              }`}>
                {status.message}
              </div>
            )}
            
            <div className="space-y-2">
              <label className="text-[10px] uppercase tracking-widest font-bold text-brand-muted">Name</label>
              <input 
                name="name" 
                type="text" 
                required 
                className="w-full bg-brand-bg border-b border-white/10 focus:border-brand-gold py-4 px-0 outline-none transition-all text-brand-text" 
              />
            </div>
            
            <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
              <div className="space-y-2">
                <label className="text-[10px] uppercase tracking-widest font-bold text-brand-muted">Email</label>
                <input 
                  name="email" 
                  type="email" 
                  required 
                  className="w-full bg-brand-bg border-b border-white/10 focus:border-brand-gold py-4 px-0 outline-none transition-all text-brand-text" 
                />
              </div>
              <div className="space-y-2">
                <label className="text-[10px] uppercase tracking-widest font-bold text-brand-muted">Phone</label>
                <input 
                  name="phone" 
                  type="tel" 
                  className="w-full bg-brand-bg border-b border-white/10 focus:border-brand-gold py-4 px-0 outline-none transition-all text-brand-text" 
                />
              </div>
            </div>
            
            <div className="space-y-2">
              <label className="text-[10px] uppercase tracking-widest font-bold text-brand-muted">Message</label>
              <textarea 
                name="message" 
                required 
                rows={4} 
                className="w-full bg-brand-bg border-b border-white/10 focus:border-brand-gold py-4 px-0 outline-none transition-all text-brand-text resize-none" 
              />
            </div>
            
            <button 
              type="submit" 
              disabled={loading}
              className="w-full bg-brand-gold text-brand-bg py-5 font-bold uppercase tracking-[0.3em] hover:bg-opacity-90 transition-all active:scale-[0.98] disabled:opacity-50 flex items-center justify-center space-x-2"
            >
              {loading && <Loader2 className="w-5 h-5 animate-spin" />}
              <span>{loading ? "Sending..." : "Send Message"}</span>
            </button>
          </form>
        </motion.div>
      </div>
    </section>
  );
}
